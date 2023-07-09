package com.example.testpfe;

import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatDialogFragment;

public class testpop extends AppCompatDialogFragment {

    private EditText text1;
    private EditText text2;
    private ExampleDialogListener listener;

    @NonNull
    @Override
    public Dialog onCreateDialog(@Nullable Bundle savedInstanceState) {
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());

        LayoutInflater inflater = getActivity().getLayoutInflater();
        View view = inflater.inflate(R.layout.activity_testpop, null);

        builder.setView(view)
                .setTitle("Change unique ID")
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                    }
                })
                .setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        String password1 = text1.getText().toString();
                        String password2 = text2.getText().toString();
                        if (password1.equals(String.valueOf(""))) {
                            listener.applyTexts("Fill all the", "fields");
                        } else if (password2.equals(String.valueOf(""))) {
                            listener.applyTexts("Fill all the", "fields");
                        } else {
                            if (password1.equals(password2))
                                listener.applyTexts("Same", "ID");

                            else {
                                listener.applyTexts("Change", "succeeded");
                            }
                        }
                    }
                });

        text1 = view.findViewById(R.id.editTextTextPassword7);
        text2 = view.findViewById(R.id.editTextTextPassword9);
        return builder.create();
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);

        try {
            listener = (ExampleDialogListener) context;
        } catch (ClassCastException e) {
            throw new ClassCastException(context.toString() +
                    "must implement ExampleDialogListener");
        }
    }

    public interface ExampleDialogListener {
        void applyTexts(String username, String password);
    }
}