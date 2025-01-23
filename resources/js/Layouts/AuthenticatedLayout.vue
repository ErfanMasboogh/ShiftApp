<script setup>
import { ref } from "vue";
// import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import MenuIcon from "@/Components/MenuIcon.vue";
import ArrowLeft from "@/Components/ArrowLeft.vue";
import { Link } from "@inertiajs/vue3";
// import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
const showingUserOptionDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gradient-to-t from-green-200 to-white">
            <nav class="border-b border-gray-300 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <!-- <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div> -->

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:ms-10 sm:flex">
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    داشبورد
                                </NavLink>
                            </div> -->
                            <div class="hidden space-x-8 sm:ms-10 sm:flex">
                                <NavLink
                                    :href="route('index')"
                                    :active="route().current('index')"
                                >
                                    صفحه اصلی
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:ms-10 sm:flex">
                                <NavLink
                                    v-if="$page.props.auth.user.is_admin"
                                    :href="route('admin.index')"
                                    :active="route().current('admin.index')"
                                >
                                    پنل ادمین
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ $page.props.auth.user.name }}
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            پروفایل
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            خروج
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            ></button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->

                <div class="m-2 sm:hidden -mt-10">
                    <MenuIcon
                        class=""
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                    ></MenuIcon>
                </div>
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            داشبورد
                        </ResponsiveNavLink>
                    </div> -->
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('index')"
                            :active="route().current('index')"
                        >
                            صفحه اصلی
                        </ResponsiveNavLink>
                    </div>
                    <div
                        v-if="$page.props.auth.user.is_admin"
                        class="space-y-1 pb-3 pt-2"
                    >
                        <ResponsiveNavLink
                            :href="route('admin.index')"
                            :active="route().current('admin.index')"
                        >
                            پنل ادمین
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        @click="
                            showingUserOptionDropdown =
                                !showingUserOptionDropdown
                        "
                        class="border-t border-gray-200 pb-1 pt-4"
                    >
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div
                            v-if="showingUserOptionDropdown"
                            class="mt-3 ml-5 space-y-1"
                        >
                            <ResponsiveNavLink :href="route('profile.edit')">
                                پروفایل
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                خروج
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <div class="justify-center">
                <h4 class="text-center text-xs">
                    <span class="opacity-70">© 2024 - تمام حقوق برای </span>
                    <span class="text-green-900 opacity-90"
                        ><a
                            target="_blank"
                            href="https://telegram.me/Erfan_Masboogh"
                        >
                            عرفان مسبوق</a
                        ></span
                    >
                    <span class="opacity-70"> محفوظ است. </span>
                </h4>
                <h4 class="opacity-70 text-center text-xs">v1.0</h4>
            </div>
        </div>
    </div>
</template>
<script setup></script>
