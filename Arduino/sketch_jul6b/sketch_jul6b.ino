#include "esp_camera.h"
#include <WiFi.h>
#include <esp_http_server.h>
#include "fb_gfx.h"
#include "fd_forward.h"
#include "fr_forward.h"
#include "dl_lib.h"
#include "fr_flash.h"
#include "obj_forward.h"

//
// WARNING!!! PSRAM IC required for UXGA resolution and high JPEG quality
//            Ensure ESP32 Wrover Module or other board with PSRAM is selected
//            Partial images will be transmitted if image exceeds buffer size
//
//            You must select partition scheme from the board menu that has at least 3MB APP space.
//            Face Recognition is DISABLED for ESP32 and ESP32-S2, because it takes up from 15 
//            seconds to process single frame. Face Detection is ENABLED if PSRAM is enabled as well

// ===================
// Select camera model
// ===================
//#define CAMERA_MODEL_WROVER_KIT // Has PSRAM
//#define CAMERA_MODEL_ESP_EYE // Has PSRAM
//#define CAMERA_MODEL_ESP32S3_EYE // Has PSRAM
//#define CAMERA_MODEL_M5STACK_PSRAM // Has PSRAM
//#define CAMERA_MODEL_M5STACK_V2_PSRAM // M5Camera version B Has PSRAM
//#define CAMERA_MODEL_M5STACK_WIDE // Has PSRAM
//#define CAMERA_MODEL_M5STACK_ESP32CAM // No PSRAM
//#define CAMERA_MODEL_M5STACK_UNITCAM // No PSRAM
#define CAMERA_MODEL_AI_THINKER // Has PSRAM
//#define CAMERA_MODEL_TTGO_T_JOURNAL // No PSRAM
//define CAMERA_MODEL_XIAO_ESP32S3 // Has PSRAM
// ** Espressif Internal Boards **
//#define CAMERA_MODEL_ESP32_CAM_BOARD
//#define CAMERA_MODEL_ESP32S2_CAM_BOARD
//#define CAMERA_MODEL_ESP32S3_CAM_LCD

#include "camera_pins.h"

// ===========================
// Enter your WiFi credentials
// ===========================
const char* ssid = "Xperia_XZ1";
const char* password = "1234abcd";

// ============================
// Object detection parameters
// ============================
#define OBJ_LABELS_COUNT 91  // Number of object labels in the model
#define OBJ_THRESHOLD 0.5    // Object detection threshold

// ============================
// Face recognition parameters
// ============================
#define FACE_RECOGNITION_THRESHOLD 350   // Face recognition threshold

typedef struct {
  httpd_req_t *req;
  size_t len;
} jpg_chunking_t;

typedef struct {
  dl_matrix3du_t *image_matrix;
  box_array_t *net_boxes;
} face_detect_data_t;

void startCameraServer();
void setupLedFlash(int pin);
void captureAndProcessImage();
void detectObjects(void *arg);
void recognizeFace(void *arg);

// Load the object detection model
#include "obj_model_data.h"
dl_matrix3d_t *obj_network = NULL;

// Load the face recognition model
#include "fr_model_data.h"
fr_model_t *face_recognizer = NULL;

void setup() {
  Serial.begin(115200);
  Serial.setDebugOutput(true);
  Serial.println();

  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sscb_sda = SIOD_GPIO_NUM;
  config.pin_sscb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 20000000;
  config.frame_size = FRAMESIZE_UXGA;
  config.pixel_format = PIXFORMAT_JPEG; // for streaming
  config.grab_mode = CAMERA_GRAB_WHEN_EMPTY;
  config.fb_count = 1;
  config.jpeg_quality = 12;
  config.fb_location = CAMERA_FB_IN_PSRAM;

  // if PSRAM IC present, init with UXGA resolution and higher JPEG quality
  //                      for larger pre-allocated frame buffer.
  if (psramFound()) {
    config.frame_size = FRAMESIZE_UXGA;
    config.jpeg_quality = 10;
    config.fb_count = 2;
    config.grab_mode = CAMERA_GRAB_LATEST;
  } else {
    config.frame_size = FRAMESIZE_SVGA;
    config.jpeg_quality = 12;
    config.fb_count = 1;
    config.fb_location = CAMERA_FB_IN_DRAM;
  }

  esp_err_t err = esp_camera_init(&config);
  if (err != ESP_OK) {
    Serial.printf("Camera init failed with error 0x%x", err);
    return;
  }

  sensor_t *s = esp_camera_sensor_get();
  if (s->id.PID == OV3660_PID) {
    s->set_vflip(s, 1);
    s->set_brightness(s, 1);
    s->set_saturation(s, -2);
  }

  // Load object detection model
  obj_network = obj_face_create();
  if (!obj_network) {
    Serial.println("Failed to load object detection model!");
    return;
  }

  // Load face recognition model
  face_recognizer = fr_load();
  if (!face_recognizer) {
    Serial.println("Failed to load face recognition model!");
    return;
  }

#if defined(LED_GPIO_NUM)
  setupLedFlash(LED_GPIO_NUM);
#endif

  WiFi.begin(ssid, password);
  WiFi.setSleep(false);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  startCameraServer();

  Serial.print("Camera Ready! Use 'http://");
  Serial.print(WiFi.localIP());
  Serial.println("' to connect");

  // Create a task to detect objects in the captured image
  xTaskCreatePinnedToCore(detectObjects, "detectObjects", 4 * 1024, NULL, 1, NULL, 1);

  // Create a task to recognize faces in the captured image
  xTaskCreatePinnedToCore(recognizeFace, "recognizeFace", 8 * 1024, NULL, 1, NULL, 1);
}

void loop() {
  delay(10);
  captureAndProcessImageVoici le code complet avec les fonctions de détection d'objets et de reconnaissance faciale ajoutées :

```cpp
#include "esp_camera.h"
#include <WiFi.h>
#include <esp_http_server.h>
#include "fb_gfx.h"
#include "fd_forward.h"
#include "fr_forward.h"
#include "dl_lib.h"
#include "fr_flash.h"
#include "obj_forward.h"

//
// WARNING!!! PSRAM IC required for UXGA resolution and high JPEG quality
//            Ensure ESP32 Wrover Module or other board with PSRAM is selected
//            Partial images will be transmitted if image exceeds buffer size
//
//            You must select partition scheme from the board menu that has at least 3MB APP space.
//            Face Recognition is DISABLED for ESP32 and ESP32-S2, because it takes up from 15 
//            seconds to process single frame. Face Detection is ENABLED if PSRAM is enabled as well

// ===================
// Select camera model
// ===================
//#define CAMERA_MODEL_WROVER_KIT // Has PSRAM
//#define CAMERA_MODEL_ESP_EYE // Has PSRAM
//#define CAMERA_MODEL_ESP32S3_EYE // Has PSRAM
//#define CAMERA_MODEL_M5STACK_PSRAM // Has PSRAM
//#define CAMERA_MODEL_M5STACK_V2_PSRAM // M5Camera version B Has PSRAM
//#define CAMERA_MODEL_M5STACK_WIDE // Has PSRAM
//#define CAMERA_MODEL_M5STACK_ESP32CAM // No PSRAM
//#define CAMERA_MODEL_M5STACK_UNITCAM // No PSRAM
#define CAMERA_MODEL_AI_THINKER // Has PSRAM
//#define CAMERA_MODEL_TTGO_T_JOURNAL // No PSRAM
//define CAMERA_MODEL_XIAO_ESP32S3 // Has PSRAM
// ** Espressif Internal Boards **
//#define CAMERA_MODEL_ESP32_CAM_BOARD
//#define CAMERA_MODEL_ESP32S2_CAM_BOARD
//#define CAMERA_MODEL_ESP32S3_CAM_LCD

#include "camera_pins.h"

// ===========================
// Enter your WiFi credentials
// ===========================
const char* ssid = "Xperia_XZ1";
const char* password = "1234abcd";

// ============================
// Object detection parameters
// ============================
#define OBJ_LABELS_COUNT 91  // Number of object labels in the model
#define OBJ_THRESHOLD 0.5    // Object detection threshold

// ============================
// Face recognition parameters
// ============================
#define FACE_RECOGNITION_THRESHOLD 350   // Face recognition threshold

typedef struct {
  httpd_req_t *req;
  size_t len;
} jpg_chunking_t;

typedef struct {
  dl_matrix3du_t *image_matrix;
  box_array_t *net_boxes;
} face_detect_data_t;

void startCameraServer();
void setupLedFlash(int pin);
void captureAndProcessImage();
void detectObjects(void *arg);
void recognizeFace(void *arg);

// Load the object detection model
#include "obj_model_data.h"
dl_matrix3d_t *obj_network = NULL;

// Load the face recognition model
#include "fr_model_data.h"
fr_model_t *face_recognizer = NULL;

void setup() {
  Serial.begin(115200);
  Serial.setDebugOutput(true);
  Serial.println();

  camera_config_t config;
  config.ledc_channel = LEDC_CHANNEL_0;
  config.ledc_timer = LEDC_TIMER_0;
  config.pin_d0 = Y2_GPIO_NUM;
  config.pin_d1 = Y3_GPIO_NUM;
  config.pin_d2 = Y4_GPIO_NUM;
  config.pin_d3 = Y5_GPIO_NUM;
  config.pin_d4 = Y6_GPIO_NUM;
  config.pin_d5 = Y7_GPIO_NUM;
  config.pin_d6 = Y8_GPIO_NUM;
  config.pin_d7 = Y9_GPIO_NUM;
  config.pin_xclk = XCLK_GPIO_NUM;
  config.pin_pclk = PCLK_GPIO_NUM;
  config.pin_vsync = VSYNC_GPIO_NUM;
  config.pin_href = HREF_GPIO_NUM;
  config.pin_sscb_sda = SIOD_GPIO_NUM;
  config.pin_sscb_scl = SIOC_GPIO_NUM;
  config.pin_pwdn = PWDN_GPIO_NUM;
  config.pin_reset = RESET_GPIO_NUM;
  config.xclk_freq_hz = 20000000;
  config.frame_size = FRAMESIZE_UXGA;
  config.pixel_format = PIXFORMAT_JPEG; // for streaming
  config.grab_mode = CAMERA_GRAB_WHEN_EMPTY;
  config.fb_count = 1;
  config.jpeg_quality = 12;
  config.fb_location = CAMERA_FB_IN_PSRAM;

  // if PSRAM IC present, init with UXGA resolution and higher JPEG quality
  //                      for larger pre-allocated frame buffer.
  if (psramFound()) {
    config.frame_size = FRAMESIZE_UXGA;
    config.jpeg_quality = 10;
    config.fb_count = 2;
    config.grab_mode = CAMERA_GRAB_LATEST;
  } else {
    config.frame_size = FRAMESIZE_SVGA;
    config.jpeg_quality = 12;
    config.fb_count = 1;
    config.fb_location = CAMERA_FB_IN_DRAM;
  }

  esp_err_t err = esp_camera_init(&config);
  if (err != ESP_OK) {
    Serial.printf("Camera init failed with error 0x%x", err);
    return;
  }

  sensor_t *s = esp_camera_sensor_get();
  if (s->id.PID == OV3660_PID) {
    s->set_vflip(s, 1);
    s->set_brightness(s, 1);
    s->set_saturation(s, -2);
  }

  // Load object detection model
  obj_network = obj_face_create();
  if (!obj_network) {
    Serial.println("Failed to load object detection model!");
    return;
  }

  // Load face recognition model
  face_recognizer = fr_load();
  if (!face_recognizer) {
    Serial.println("Failed to load face recognition model!");
    return;
  }

#if defined(LED_GPIO_NUM)
  setupLedFlash(LED_GPIO_NUM);
#endif

  WiFi.begin(ssid, password);
  WiFi.setSleep(false);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  startCameraServer();

  Serial.print("Camera Ready! Use 'http://");
  Serial.print(WiFi.localIP());
  Serial.println("' to connect");

  // Create a task to detect objects in the captured image
  xTaskCreatePinnedToCore(detectObjects, "detectObjects", 4 * 1024, NULL, 1, NULL, 1);

  // Create a task to recognize faces in the captured image
  xTaskCreatePinnedToCore(recognizeFace, "recognizeFace", 8 * 1024, NULL, 1, NULL, 1);
}

void loop() {
  delay(10);
  captureAndProcessImage();
}

void captureAndProcessImage() {
  camera_fb_t *fb = NULL;
  fb = esp_camera_fb_get();
  if (!fb) {
    Serial.println("Failed to capture image");
    return;
  }

  dl_matrix3du_t *image_matrix = dl_matrix3Désolé, mais la réponse précédente était incomplète. Voici la suite du code :

```cpp
  dl_matrix3du_t *image_matrix = dl_matrix3du_alloc(1, fb->width, fb->height, 3);
  fmt2rgb888(fb->buf, fb->len, fb->format, image_matrix->item);

  // Perform face detection
  box_array_t *net_boxes = NULL;
  face_detect_data_t face_detect_data = {image_matrix, net_boxes};
  xQueueSend(face_detect_task_queue, &face_detect_data, portMAX_DELAY);

  // Perform object detection
  obj_list_t *obj_list = obj_detect(image_matrix, obj_network, OBJ_THRESHOLD, 0.5);
  if (obj_list) {
    Serial.println("Detected objects:");
    for (int i = 0; i < obj_list->len; i++) {
      obj_info_t *obj = &(obj_list->obj_info[i]);
      Serial.print(" - ");
      Serial.print(obj->label);
      Serial.print(" (");
      Serial.print(obj->prob);
      Serial.println(")");
    }
    Serial.println();
    obj_list_free(obj_list);
  }

  // Free memory
  dl_matrix3du_free(image_matrix);
  esp_camera_fb_return(fb);
}
