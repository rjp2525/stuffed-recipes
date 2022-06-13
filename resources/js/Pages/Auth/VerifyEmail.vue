<script setup>
import { computed } from "vue";
import StuffedButton from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import AuthenticationCard from "@/Components/Cards/AuthenticationCard.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <authentication-card>
            <div class="card-header">
                <h2 class="title">Verify Email</h2>
                <p class="subtitle text-left">
                    Thanks for signing up! Before getting started, could you
                    verify your email address by clicking on the link we just
                    emailed to you? If you didn't receive the email, we will
                    gladly send you another.
                </p>
            </div>

            <div
                class="border-l-4 border-l-green-600 bg-green-100/20 p-4 mb-4 font-medium text-sm text-green-600"
                v-if="verificationLinkSent"
            >
                A new verification link has been sent to the email address you
                provided during registration.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-4 flex items-center justify-between">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="transition-all underline text-sm text-gray-600 hover:text-brand-800"
                        >Log Out</Link
                    >
                    <StuffedButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing || verificationLinkSent"
                    >
                        Resend Verification Email
                    </StuffedButton>
                </div>
            </form>
        </authentication-card>
    </GuestLayout>
</template>
