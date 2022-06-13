<template>
    <div class="navbar">
        <div class="navbar-wrap">
            <div class="navbar-inner">
                <div class="logo">
                    <Link :href="route('homepage')" class="logo">
                        <svg-image
                            image="logo"
                            class="h-11 w-auto text-white p-1"
                        />
                    </Link>
                </div>
                <div class="menu">
                    <ul class="main-navigation">
                        <li>
                            <Link :href="route('homepage')" class="nav-link">
                                Home
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('homepage')" class="nav-link">
                                Recipes
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('homepage')" class="nav-link">
                                About
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('homepage')" class="nav-link">
                                Search
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('login')" class="nav-link">
                                Login
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('register')" class="nav-link">
                                Register
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import SvgImage from "@/Components/Images/SvgImage";

const showingNavigationDropdown = ref(false);
</script>
