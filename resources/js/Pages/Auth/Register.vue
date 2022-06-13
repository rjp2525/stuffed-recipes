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
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="form-group">
                    <label for="tos" class="checkbox">
                        <StuffedCheckbox v-model:checked="form.remember" />
                        <svg class="check-icon" viewBox="0 0 21 21">
                            <polyline
                                points="5 10.75 8.5 14.25 16 6"
                            ></polyline>
                        </svg>
                        I agree to the
                        <a href="#" class="mx-1">Terms of Service</a> and
                        <a href="#" class="mx-1">Privacy Policy</a>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900"
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
