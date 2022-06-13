<script setup>
import StuffedButton from "@/Components/Button.vue";
import StuffedCheckbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import StuffedInput from "@/Components/Input.vue";
import StuffedLabel from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Sign in</h2>
                <p class="subtitle">
                    Save recipes, add new or fork existing ones and more!
                </p>
            </div>

            <ValidationErrors class="mb-4" />

            <div
                v-if="status"
                class="border-l-4 border-l-green-600 bg-green-100/20 p-4 mb-4 font-medium text-sm text-green-600"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="form-group">
                    <StuffedLabel for="email" value="Email" />
                    <StuffedInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.email }"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                </div>

                <div class="form-group">
                    <StuffedLabel for="password" value="Password" />
                    <StuffedInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.password }"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                </div>

                <div class="form-group">
                    <label for="remember" class="checkbox-group">
                        <StuffedCheckbox
                            name="remember"
                            v-model:checked="form.remember"
                        />
                        <svg class="check-icon" viewBox="0 0 21 21">
                            <polyline
                                points="5 10.75 8.5 14.25 16 6"
                            ></polyline>
                        </svg>
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="transition-all underline text-sm text-gray-600 hover:text-brand-600"
                    >
                        Forgot your password?
                    </Link>

                    <StuffedButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </StuffedButton>
                </div>

                <div
                    class="my-5 border-b border-solid border-b-zinc-200 w-full"
                ></div>

                <div class="flex justify-evenly">
                    <a
                        href="#"
                        class="stuffed-button transition-all bg-facebook-500 hover:bg-facebook-700 focus:bg-facebook-700 active:bg-facebook-700"
                        >Login with Facebook</a
                    >
                    <a
                        href="#"
                        class="stuffed-button transition-all bg-twitter-500 hover:bg-twitter-700 focus:bg-twitter-700 active:bg-twitter-700 ml-2"
                        >Login with Twitter</a
                    >
                </div>

                <div class="text-center">
                    <p class="text-xs text-zinc-400 mt-4">
                        Don't have an account yet?
                        <Link
                            :href="route('register')"
                            class="underline text-brand-500 transition-all hover:text-brand-700 focus:text-brand-800 active:text-brand-800"
                            >Register now!</Link
                        >
                    </p>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
