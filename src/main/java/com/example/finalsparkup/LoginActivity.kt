package com.example.finalsparkup

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import android.widget.Button
import android.widget.CheckBox
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment

class LoginActivity : AppCompatActivity() {

    lateinit var studentIDInput: EditText
    lateinit var password: EditText
    lateinit var signInButton: Button
    lateinit var rememberMeCheckbox: CheckBox

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        studentIDInput = findViewById(R.id.StudentId)
        password = findViewById(R.id.Password)
        signInButton = findViewById(R.id.SignInButton)
        rememberMeCheckbox = findViewById(R.id.RememberMe)



        signInButton.setOnClickListener {
            val studentID = studentIDInput.text.toString()
            val pass = password.text.toString()

            Toast.makeText(this, "Student ID: $studentID\nPassword: $pass", Toast.LENGTH_SHORT).show()


            val intent = Intent(this, BottomNavigationHolder::class.java)
            startActivity(intent)
            finish()

        }

        // Navigate to Sign Up Screen
        val signUpLink = findViewById<TextView>(R.id.Likessss)
        signUpLink.setOnClickListener {
            val intent = Intent(this, Signup::class.java)
            startActivity(intent)
        }
    }

    private fun replaceFragment(fragment: Fragment) {
        supportFragmentManager.beginTransaction()
            .replace(android.R.id.content, fragment)
            .addToBackStack(null)
            .commit()
    }
}
