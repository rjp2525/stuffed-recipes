<script setup>
import StuffedButton from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import StuffedInput from "@/Components/Input.vue";
import StuffedLabel from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Forgot Password</h2>
                <p class="subtitle text-left">
                    Forgot your password? No problem. Just let us know your
                    email address and we will email you a password reset link
                    that will allow you to choose a new one.
                </p>
            </div>

            <ValidationErrors class="mb-4" />

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
                        autocomplete="new-password"
                    />
                </div>

                <div class="form-group">
                    <StuffedLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <StuffedInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.password }"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <StuffedButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Reset Password
                    </StuffedButton>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
