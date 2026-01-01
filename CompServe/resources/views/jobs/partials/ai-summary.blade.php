{{-- resources/views/freelancer/jobs/partials/ai-summary.blade.php --}}
<div
    class="card bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 shadow-2xl border-2 border-primary/30 hover:border-primary/50 transition-all duration-300">
    <div class="card-body">
        <!-- Enhanced Header with Animation -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="card-title text-2xl flex items-center gap-3">
                <span class="text-3xl animate-pulse">🤖</span>
                <span
                    class="bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent font-bold">
                    AI Summary
                </span>
            </h2>
        </div>

        <!-- Summary Content with Enhanced Styling -->
        <div id="summaryContent"
            class="min-h-[120px] transition-all duration-300">
            <div
                class="flex flex-col items-center justify-center gap-4 p-8 bg-base-200/50 rounded-xl border-2 border-dashed border-base-300">
                <div class="bg-primary/10 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-primary"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-base-content mb-1">Ready to
                        Summarize</p>
                    <p class="text-sm text-base-content/60">Click below to
                        generate an AI-powered overview</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Loading State -->
        <div id="loadingState"
            class="hidden">
            <div class="flex flex-col items-center justify-center py-12 gap-6">
                <div class="relative">
                    <span
                        class="loading loading-spinner loading-lg text-primary"></span>
                    <div
                        class="absolute inset-0 loading loading-spinner loading-lg text-secondary opacity-50 animate-ping">
                    </div>
                </div>
                <div class="text-center space-y-2">
                    <p class="text-lg font-semibold text-base-content">
                        Generating Summary...</p>
                    <p class="text-sm text-base-content/60">Our AI is analyzing
                        the job listing</p>
                </div>
                <div class="flex gap-2">
                    <span
                        class="loading loading-dots loading-sm text-primary"></span>
                </div>
            </div>
        </div>

        <!-- Enhanced Error State -->
        <div id="errorState"
            class="hidden">
            <div class="alert alert-error shadow-xl border-2 border-error/50">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="stroke-current shrink-0 h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h3 class="font-bold">Oops! Something went wrong</h3>
                    <div class="text-xs"
                        id="errorMessage">Failed to generate summary. Please try
                        again.</div>
                </div>
            </div>
        </div>

        <!-- Enhanced Action Buttons -->
        <div class="card-actions justify-end mt-6 gap-3">
            <button onclick="generateSummary()"
                id="generateBtn"
                class="btn btn-primary gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                Generate Summary
            </button>
            <button onclick="clearSummary()"
                id="clearBtn"
                class="btn btn-ghost gap-2 hidden hover:bg-error/10 hover:text-error transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear
            </button>
        </div>

        <!-- Helpful Tip -->
        <div class="mt-4 p-4 bg-info/5 border border-info/20 rounded-xl">
            <div class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-info shrink-0 mt-0.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-xs font-semibold text-info mb-1">Pro Tip</p>
                    @if (Auth::user()->role === 'freelancer')
                        <p class="text-xs text-base-content/70">The AI summary
                            provides a quick overview to help you decide if this
                            job
                            matches your skills!</p>
                    @elseif(Auth::user()->role === 'client')
                        <p class="text-xs text-base-content/70">The AI summary
                            provides a quick overview regarding your posted gig
                            or contract!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function generateSummary() {
        const summaryContent = document.getElementById('summaryContent');
        const loadingState = document.getElementById('loadingState');
        const errorState = document.getElementById('errorState');
        const generateBtn = document.getElementById('generateBtn');
        const clearBtn = document.getElementById('clearBtn');

        // Show loading state with animation
        summaryContent.classList.add('hidden');
        errorState.classList.add('hidden');
        loadingState.classList.remove('hidden');
        generateBtn.disabled = true;

        try {
            const response = await fetch(
                '{{ route('jobs.summarize', $jobListing) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Failed to generate summary');
            }

            // Display summary with enhanced formatting
            summaryContent.innerHTML = formatSummary(data.summary);
            summaryContent.classList.remove('hidden');
            summaryContent.classList.add('animate-fade-in');
            clearBtn.classList.remove('hidden');

            // Update button with regenerate icon
            generateBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Regenerate Summary
            `;

        } catch (error) {
            console.error('Error:', error);
            errorState.classList.remove('hidden');
            document.getElementById('errorMessage').textContent = error
                .message;
            summaryContent.classList.remove('hidden');
        } finally {
            loadingState.classList.add('hidden');
            generateBtn.disabled = false;
        }
    }

    function formatSummary(summary) {
        const sections = summary.split('\n\n').filter(s => s.trim());
        let formattedHTML = '<div class="space-y-5 animate-fade-in">';

        sections.forEach((section, index) => {
            const lines = section.split('\n').map(l => l.trim()).filter(
                l => l);
            const headerMatch = lines[0].match(/^(\d+)\.\s*(.+)/);

            if (headerMatch) {
                const sectionNumber = headerMatch[1];
                const sectionTitle = headerMatch[2].replace(/\*\*/g,
                    '');

                formattedHTML += `
                    <div class="card bg-gradient-to-br from-base-200/80 to-base-300/30 shadow-lg border-l-4 border-primary hover:shadow-xl transition-all duration-300 hover:scale-[1.01]">
                        <div class="card-body p-5">
                            <div class="flex items-start gap-4">
                                <div class="badge badge-primary badge-lg font-bold text-lg px-3 py-4 shadow-md">${sectionNumber}</div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl mb-4 text-primary flex items-center gap-2">
                                        ${sectionTitle}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </h3>
                `;

                if (lines.length > 1) {
                    const content = lines.slice(1);
                    const hasBullets = content.some(line =>
                        line.startsWith('-') || line.startsWith(
                            '•') || line.startsWith('*')
                    );

                    if (hasBullets) {
                        formattedHTML += '<ul class="space-y-3">';
                        content.forEach(line => {
                            if (line.startsWith('-') || line
                                .startsWith('•') || line
                                .startsWith('*')) {
                                const text = line.replace(
                                        /^[-•*]\s*/, '')
                                    .replace(
                                        /\*\*(.+?)\*\*/g,
                                        '<strong class="text-accent font-semibold">$1</strong>'
                                    );
                                formattedHTML += `
                                    <li class="flex items-start gap-3 group">
                                        <div class="bg-primary/10 p-1.5 rounded-lg mt-0.5 group-hover:bg-primary/20 transition-colors">
                                            <svg class="h-4 w-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <span class="text-base-content/90 leading-relaxed flex-1">${text}</span>
                                    </li>
                                `;
                            } else if (line.trim()) {
                                formattedHTML +=
                                    `<p class="text-base-content/80 leading-relaxed pl-1">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent font-semibold">$1</strong>')}</p>`;
                            }
                        });
                        formattedHTML += '</ul>';
                    } else {
                        content.forEach(line => {
                            if (line.trim()) {
                                formattedHTML +=
                                    `<p class="text-base-content/80 leading-relaxed mb-2 pl-1">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent font-semibold">$1</strong>')}</p>`;
                            }
                        });
                    }
                }

                formattedHTML += `
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                const hasBullets = lines.some(line =>
                    line.startsWith('-') || line.startsWith('•') ||
                    line.startsWith('*')
                );

                formattedHTML +=
                    '<div class="prose max-w-none bg-base-200/30 p-5 rounded-xl border border-base-300">';

                if (hasBullets) {
                    let inList = false;
                    lines.forEach(line => {
                        if (line.startsWith('-') || line
                            .startsWith('•') || line.startsWith(
                                '*')) {
                            if (!inList) {
                                formattedHTML +=
                                    '<ul class="space-y-3 mt-3">';
                                inList = true;
                            }
                            const text = line.replace(
                                /^[-•*]\s*/, '').replace(
                                /\*\*(.+?)\*\*/g,
                                '<strong class="text-accent font-semibold">$1</strong>'
                            );
                            formattedHTML += `
                                <li class="flex items-start gap-3 group">
                                    <div class="bg-primary/10 p-1.5 rounded-lg mt-0.5 group-hover:bg-primary/20 transition-colors">
                                        <svg class="h-4 w-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-base-content/90 leading-relaxed flex-1">${text}</span>
                                </li>
                            `;
                        } else if (line.trim()) {
                            if (inList) {
                                formattedHTML += '</ul>';
                                inList = false;
                            }
                            formattedHTML +=
                                `<p class="text-base-content/90 leading-relaxed text-lg mb-3 font-medium">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
                        }
                    });
                    if (inList) {
                        formattedHTML += '</ul>';
                    }
                } else {
                    lines.forEach(line => {
                        if (line.trim()) {
                            formattedHTML +=
                                `<p class="text-base-content/90 leading-relaxed text-lg mb-3 font-medium">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
                        }
                    });
                }

                formattedHTML += '</div>';
            }
        });

        formattedHTML += '</div>';
        return formattedHTML;
    }

    function clearSummary() {
        const summaryContent = document.getElementById('summaryContent');
        const clearBtn = document.getElementById('clearBtn');
        const generateBtn = document.getElementById('generateBtn');

        summaryContent.innerHTML = `
            <div class="flex flex-col items-center justify-center gap-4 p-8 bg-base-200/50 rounded-xl border-2 border-dashed border-base-300">
                <div class="bg-primary/10 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-base-content mb-1">Ready to Summarize</p>
                    <p class="text-sm text-base-content/60">Click below to generate an AI-powered overview</p>
                </div>
            </div>
        `;

        clearBtn.classList.add('hidden');
        generateBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
            Generate Summary
        `;
    }
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
</style>
