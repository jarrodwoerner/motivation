<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 p-6">
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <a href="/" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Quote</h1>

                <div v-if="$page.props.flash?.success" class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ $page.props.flash.success }}
                </div>

                <form @submit.prevent="submit">
                    <div class="mb-6">
                        <label for="quote" class="block text-sm font-semibold text-gray-700 mb-2">
                            Quote <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="quote"
                            v-model="form.quote"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter the quote..."
                            required
                        ></textarea>
                        <p v-if="form.errors.quote" class="mt-1 text-sm text-red-600">{{ form.errors.quote }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="author"
                            v-model="form.author"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Author name"
                            required
                        />
                        <p v-if="form.errors.author" class="mt-1 text-sm text-red-600">{{ form.errors.author }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="source" class="block text-sm font-semibold text-gray-700 mb-2">
                            Source <span class="text-gray-400">(optional)</span>
                        </label>
                        <input
                            type="text"
                            id="source"
                            v-model="form.source"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Book, speech, or context..."
                        />
                        <p v-if="form.errors.source" class="mt-1 text-sm text-red-600">{{ form.errors.source }}</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Tags <span class="text-gray-400">(select all that apply)</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <label
                                v-for="tag in tags"
                                :key="tag.id"
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition"
                                :class="{ 'bg-blue-100 border-blue-500': form.tags.includes(tag.id) }"
                            >
                                <input
                                    type="checkbox"
                                    :value="tag.id"
                                    v-model="form.tags"
                                    class="mr-2"
                                />
                                <span class="text-sm">{{ tag.name }}</span>
                            </label>
                        </div>
                        <p v-if="form.errors.tags" class="mt-1 text-sm text-red-600">{{ form.errors.tags }}</p>
                    </div>

                    <div class="flex gap-4">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition"
                        >
                            {{ form.processing ? 'Adding...' : 'Add Quote' }}
                        </button>
                        <button
                            type="button"
                            @click="resetForm"
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition"
                        >
                            Clear Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    tags: {
        type: Array,
        required: true
    }
});

const form = useForm({
    quote: '',
    author: '',
    source: '',
    tags: []
});

const submit = () => {
    form.post('/quotes', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    });
};

const resetForm = () => {
    form.reset();
};
</script>
