<script setup>
import StuffedButton from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import StuffedInput from "@/Components/Input.vue";
import StuffedLabel from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Forgot Password</h2>
                <p class="subtitle text-left">
                    Forgot your password? No problem. Just let us know your
                    email address and we will email you a password reset link
                    that will allow you to choose a new one.
                </p>
            </div>

            <div
                v-if="status"
                class="border-l-4 border-l-green-600 bg-green-100/20 p-4 mb-4 font-medium text-sm text-green-600"
            >
                {{ status }}
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

                <div class="flex items-center justify-center mt-4">
                    <StuffedButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Email Password Reset Link
                    </StuffedButton>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
