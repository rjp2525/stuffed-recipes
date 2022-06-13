<script setup>
import StuffedButton from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import StuffedInput from "@/Components/Input.vue";
import StuffedLabel from "@/Components/Label.vue";
import StuffedCheckbox from "@/Components/Checkbox.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Create an Account :: Stuffed Recipes" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Create an Account</h2>
                <p class="subtitle">
                    Save recipes, add new or fork existing ones and more!
                </p>
            </div>

            <ValidationErrors class="mb-4" />

            <form @submit.prevent="submit">
                <div class="form-group">
                    <StuffedLabel for="name" value="Name" />
                    <StuffedInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.name }"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </div>

                <div class="form-group">
                    <StuffedLabel for="email" value="Email" />
                    <StuffedInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.email }"
                        v-model="form.email"
                        required
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
                        :class="{ error: form.errors.password_confirmation }"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="form-group">
                    <label for="terms" class="checkbox-group">
                        <StuffedCheckbox v-model:checked="form.terms" />
                        <svg class="check-icon" viewBox="0 0 21 21">
                            <polyline
                                points="5 10.75 8.5 14.25 16 6"
                            ></polyline>
                        </svg>
                        I agree to the
                        <a href="#" class="brand-link">Terms of Service</a> and
                        <a href="#" class="brand-link">Privacy Policy</a>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm transition-all text-gray-600 hover:text-brand-700"
                    >
                        Already registered?
                    </Link>

                    <StuffedButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </StuffedButton>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
