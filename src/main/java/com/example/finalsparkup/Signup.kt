package com.example.finalsparkup

import android.content.Intent
import android.os.Bundle
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast

class Signup : AppCompatActivity() {
    lateinit var NameInput: EditText
    lateinit var PhinmaedEmailInput: EditText
    lateinit var StudentNumberInput: EditText
    lateinit var DepartmentInput: EditText
    lateinit var ProgramInput: EditText
    lateinit var Password: EditText
    lateinit var ConfirmPasswordInput: EditText
    lateinit var SignUpButton: Button
    lateinit var tvSignin: TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.signup)

        NameInput = findViewById(R.id.Name)
        PhinmaedEmailInput = findViewById(R.id.PhinmaedEmail)
        StudentNumberInput = findViewById(R.id.StudentNumber)
        DepartmentInput = findViewById(R.id.Department)
        ProgramInput = findViewById(R.id.Program)
        Password = findViewById(R.id.Password)
        ConfirmPasswordInput = findViewById(R.id.ConfirmPassword)
        SignUpButton = findViewById(R.id.SignUp)
        tvSignin = findViewById(R.id.tvSignin)



        SignUpButton.setOnClickListener {
            val Name = NameInput.text.toString()
            val PhinmaedEmail = PhinmaedEmailInput.text.toString()
            val StudentNumber = StudentNumberInput.text.toString()
            val Department = DepartmentInput.text.toString()
            val Program = ProgramInput.text.toString()
            val Password = Password.text.toString()
            val ConfirmPassword = ConfirmPasswordInput.text.toString()
            val SignUp = SignUpButton.text.toString()


            Toast.makeText(
                this,
                "Name: $Name \n PhinmaedEmail: $PhinmaedEmail \n StudentNumber: $StudentNumber \n Department: $Department \n" +
                        "Program: $Program \n Password: $Password \n ConfirmPassword: $ConfirmPassword \n SignUp: $SignUp",
                Toast.LENGTH_SHORT
            ).show()

        }
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.signupmm)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        val signUpLink = findViewById<TextView>(R.id.tvSignin)
        signUpLink.setOnClickListener {
            val intent = Intent(this, LoginActivity::class.java)
            startActivity(intent)
        }



    }
}