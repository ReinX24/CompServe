<div
    class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
    <!-- Decorative Background -->
    <div class="absolute inset-0 opacity-5">
        <div
            class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
        </div>
        <div
            class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
        </div>
    </div>

    <div class="relative p-8 md:p-10 text-center">
        <!-- Icon -->
        <div class="inline-flex items-center justify-center mb-4">
            <div
                class="bg-linear-to-br from-primary to-primary/70 p-4 rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-12 h-12 text-white">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-bold text-base-content mb-2">
            {{ $jobType === 'gig' ? __('Create a New Gig') : ($jobType === 'contract' ? __('Create a New Contract') : __('Create a New Job')) }}
        </h1>
        <p class="text-base md:text-lg text-base-content/70 max-w-2xl mx-auto">
            {{ $jobType === 'gig' ? __('Fill out the details to post a gig and find the perfect freelancer.') : ($jobType === 'contract' ? __('Fill out the details to post a contract and connect with professionals.') : __('Fill out the details to post a job.')) }}
        </p>
    </div>
</div>
