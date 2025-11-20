<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-slate-900 flex items-center justify-center p-6 transition-colors duration-300">
        <DarkModeToggle />

        <div class="max-w-4xl w-full">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-2">Daily Motivation</h1>
                <p class="text-gray-600 dark:text-gray-400">Your Quote of the Day</p>
            </div>

            <div v-if="quote" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 md:p-12 transition-colors duration-300">
                <div class="mb-8">
                    <svg class="w-12 h-12 text-blue-500 dark:text-blue-400 mb-4" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M10 8c-3.3 0-6 2.7-6 6s2.7 6 6 6c1.4 0 2.6-.5 3.6-1.2-.3 2.8-2.7 5.2-5.6 5.2v4c5.5 0 10-4.5 10-10V8h-8zm16 0c-3.3 0-6 2.7-6 6s2.7 6 6 6c1.4 0 2.6-.5 3.6-1.2-.3 2.8-2.7 5.2-5.6 5.2v4c5.5 0 10-4.5 10-10V8h-8z"/>
                    </svg>
                    <p class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 leading-relaxed font-serif italic">
                        {{ quote.quote }}
                    </p>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <p class="text-xl text-gray-700 dark:text-gray-200 font-semibold mb-2">
                        &mdash; {{ quote.author }}
                    </p>
                    <p v-if="quote.source" class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ quote.source }}
                    </p>

                    <div v-if="quote.tags && quote.tags.length > 0" class="flex flex-wrap gap-2 mt-4">
                        <span
                            v-for="tag in quote.tags"
                            :key="tag.id"
                            class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 rounded-full text-sm font-medium"
                        >
                            {{ tag.name }}
                        </span>
                    </div>
                </div>
            </div>

            <div v-else class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-12 text-center transition-colors duration-300">
                <p class="text-xl text-gray-600 dark:text-gray-400">No quote available yet. Add some quotes to the database!</p>
            </div>

            <div class="text-center mt-8">
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">A new quote appears every day</p>
                <a
                    href="/quotes/create"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Quote
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import DarkModeToggle from '../Components/DarkModeToggle.vue';

defineProps({
    quote: {
        type: Object,
        default: null
    }
});
</script>
