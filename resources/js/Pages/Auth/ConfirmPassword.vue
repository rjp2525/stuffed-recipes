<script setup>
import StuffedButton from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import StuffedInput from "@/Components/Input.vue";
import StuffedLabel from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Confirm Password</h2>
                <p class="subtitle text-left">
                    The requested page is a secure area. Please confirm your
                    password before continuing.
                </p>
            </div>

            <ValidationErrors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <StuffedLabel for="password" value="Password" />
                    <StuffedInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        :class="{ error: form.errors.password }"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                </div>

                <div class="flex justify-end mt-4">
                    <StuffedButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Confirm
                    </StuffedButton>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
