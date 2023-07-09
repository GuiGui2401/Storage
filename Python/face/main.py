import face_recognition
import cv2
import numpy as np
from playsound import playsound
import threading

# This is a demo of running face recognition on live video from your webcam. It's a little more complicated than the
# other example, but it includes some basic performance tweaks to make things run a lot faster:
#   1. Process each video frame at 1/4 resolution (though still display it at full resolution)
#   2. Only detect faces in every other frame of video.

# PLEASE NOTE: This example requires OpenCV (the `cv2` library) to be installed only to read from your webcam.
# OpenCV is *not* required to use the face_recognition library. It's only required if you want to run this
# specific demo. If you have trouble installing it, try any of the other demos that don't require it instead.

# Get a reference to webcam #0 (the default one)
video_capture = cv2.VideoCapture(0)
video_capture2 = cv2.VideoCapture(1)
# Load a sample picture and learn how to recognize it.

hourey_image = face_recognition.load_image_file("hourey/Hourey.jpg")
hourey_face_encoding = face_recognition.face_encodings(hourey_image)[0]


cedric_image = face_recognition.load_image_file("cedric/Cedric.jpg")
cedric_face_encoding = face_recognition.face_encodings(cedric_image)[0]

aicha_image = face_recognition.load_image_file("aicha/Aicha.jpg")
aicha_face_encoding = face_recognition.face_encodings(aicha_image)[0]

anderson_image = face_recognition.load_image_file("anderson/Anderson.jpg")
anderson_face_encoding = face_recognition.face_encodings(anderson_image)[0]

# Load a second sample picture and learn how to recognize it.
bradley_image = face_recognition.load_image_file("Bradley/bradley.jpg")
bradley_face_encoding = face_recognition.face_encodings(bradley_image)[0]

# Create arrays of known face encodings and their names
known_face_encodings = [

    bradley_face_encoding,
    hourey_face_encoding,
    cedric_face_encoding,
    aicha_face_encoding,
    anderson_face_encoding, 

]

known_face_encodings2 = [

    bradley_face_encoding,
    hourey_face_encoding,
    cedric_face_encoding,
    aicha_face_encoding,
    anderson_face_encoding, 

]
known_face_names = [
    #
    #"Krish",
    "Bradley",
    "Hourey",
    "Cedric",
    "Aicha",
    "Anderson"

]
known_face_names2 = [
    #
    #"Krish",
    "Bradley",
    "Hourey",
    "Cedric",
    "Aicha",
    "Anderson"

]

# Initialize some variables
face_locations = []
face_encodings = []
face_names = []
face_locations2 = []
face_encodings2 = []
face_names2 = []
process_this_frame = True
process_this_frame2 = True

def play_sound():
    playsound("C:\\Users\\ADAMA\\Desktop\\face\\son.wav")
while True:
    # Grab a single frame of vi

    ret, frame = video_capture.read()
    ret2, frame2 = video_capture2.read()

    # Resize frame of video to 1/4 size for faster face recognition processing
    small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
    small_frame2 = cv2.resize(frame2, (0, 0), fx=0.25, fy=0.25)

    # Convert the image from BGR color (which OpenCV uses) to RGB color (t10  which face_recognition uses)
    rgb_small_frame = small_frame[:, :, ::-1]
    rgb_small_frame2 = small_frame2[:, :, ::-1]

    # Only process every other frame of video to save time
    if process_this_frame:
        # Find all the faces and face encodings in the current frame of video
        face_locations = face_recognition.face_locations(rgb_small_frame)
        face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)
        face_locations2 = face_recognition.face_locations(rgb_small_frame2)
        face_encodings2 = face_recognition.face_encodings(rgb_small_frame2, face_locations2)
        face_names = []
        face_names2 = []
        for face_encoding in face_encodings:
            # See if the face is a match for the known face(s)
            matches = face_recognition.compare_faces(known_face_encodings, face_encoding)
            name = "Unknown"

            # # If a match was found in known_face_encodings, just use the first one.
            # if True in matches:
            #     first_match_index = matches.index(True)
            #     name = known_face_names[first_match_index]

            # Or instead, use the known face with the smallest distance to the new face
            face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
            best_match_index = np.argmin(face_distances)
            if matches[best_match_index]:
                name = known_face_names[best_match_index]
                print("Alerte le patient "+ name + "est dans une zone interdite")
                threading.Thread(target=play_sound())
                cv2.imwrite("img.jpg", frame)

            face_names.append(name)
    process_this_frame = not process_this_frame

    if process_this_frame2:
        for face_encoding2 in face_encodings2:
            # See if the face is a match for the known face(s)
            matches2 = face_recognition.compare_faces(known_face_encodings2, face_encoding2)
            name2 = "Unknown"

            # # If a match was found in known_face_encodings, just use the first one.
            # if True in matches:
            #     first_match_index = matches.index(True)
            #     name = known_face_names[first_match_index]

            # Or instead, use the known face with the smallest distance to the new face
            face_distances2 = face_recognition.face_distance(known_face_encodings2, face_encoding2)
            best_match_index2 = np.argmin(face_distances2)
            if matches2[best_match_index2]:
                name2 = known_face_names2[best_match_index2]
                print("Alerte le patient "+ name2 + "est dans une zone interdite")
                threading.Thread(target=play_sound())
                cv2.imwrite("img.jpg", frame2)

            face_names2.append(name2)

    process_this_frame2 = not process_this_frame2


    # Display the results
    for (top, right, bottom, left), name in zip(face_locations, face_names):
        # Scale back up face locations since the frame we detected in was scaled to 1/4 size
        top *= 4
        right *= 4
        bottom *= 4
        left *= 4

        # Draw a box around the face
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)

        # Draw a label with a name below the face
        cv2.rectangle(frame, (left, bottom - 35), (right, bottom), (0, 0, 255), cv2.FILLED)
        font = cv2.FONT_HERSHEY_DUPLEX
        cv2.putText(frame, name, (left + 6, bottom - 6), font, 1.0, (255, 255, 255), 1)
 
    # Display the resulting image
    cv2.imshow('Video', frame)

    for (top2, right2, bottom2, left2), name2 in zip(face_locations2, face_names2):
        # Scale back up face locations since the frame we detected in was scaled to 1/4 size
        top2 *= 4
        right2 *= 4
        bottom2 *= 4
        left2 *= 4

        # Draw a box around the face
        cv2.rectangle(frame2, (left2, top2), (right2, bottom2), (0, 0, 255), 2)

        # Draw a label with a name below the face
        cv2.rectangle(frame2, (left2, bottom2 - 35), (right2, bottom2), (0, 0, 255), cv2.FILLED)
        font2 = cv2.FONT_HERSHEY_DUPLEX
        cv2.putText(frame2, name2, (left + 6, bottom - 6), font2, 1.0, (255, 255, 255), 1)
 
    # Display the resulting image
    cv2.imshow('Video', frame2)

    # Hit 'q' on the keyboard to quit!
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release handle to the webcam
video_capture.release()
video_capture2.release()
cv2.destroyAllWindows()