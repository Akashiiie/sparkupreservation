package com.example.finalsparkup

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import com.google.android.material.bottomnavigation.BottomNavigationView

class BottomNavigationHolder : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.bottomnavbar)

        val bottomNavigationView = findViewById<BottomNavigationView>(R.id.bottom_navigation)

        // Load the default fragment Home Tanga
        if (savedInstanceState == null) {
            loadFragment(homefragment())
        }

        bottomNavigationView.setOnItemSelectedListener { item ->
            when (item.itemId) {
                R.id.Homess -> loadFragment(homefragment())
                R.id.Eventss -> loadFragment(eventfragment())
                R.id.Bellss -> loadFragment(notificationfragment())
                R.id.Personss -> loadFragment(profilefragment())
            }
            true
        }
    }

    private fun loadFragment(fragment: Fragment) {
        supportFragmentManager.beginTransaction()
            .replace(R.id.lalalala, fragment)
            .commit()
    }
}