{{-- resources/views/freelancer/jobs/partials/ai-summary.blade.php --}}
<div
    class="card bg-linear-to-br from-primary/5 to-secondary/5 shadow-xl border border-primary/20">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4 flex items-center gap-2">
            <span class="text-2xl">🤖</span>
            AI Summary
            <div class="badge badge-primary badge-sm">Powered by Gemini</div>
        </h2>

        {{-- Summary Content --}}
        <div id="summaryContent"
            class="min-h-[100px]">
            <div class="flex items-center gap-3 text-base-content/60">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Click "Generate Summary" to get an AI-powered overview of
                    this job listing.</span>
            </div>
        </div>

        {{-- Loading State --}}
        <div id="loadingState"
            class="hidden">
            <div class="flex flex-col items-center justify-center py-8 gap-4">
                <span
                    class="loading loading-spinner loading-lg text-primary"></span>
                <span class="text-base-content/70 font-medium">Generating AI
                    summary...</span>
            </div>
        </div>

        {{-- Error State --}}
        <div id="errorState"
            class="hidden alert alert-error shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="stroke-current shrink-0 h-6 w-6"
                fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="errorMessage">Failed to generate summary. Please try
                again.</span>
        </div>

        {{-- Action Buttons --}}
        <div class="card-actions justify-end mt-4">
            <button onclick="generateSummary()"
                id="generateBtn"
                class="btn btn-primary gap-2">
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
                class="btn btn-ghost gap-2 hidden">
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
    </div>
</div>

<script>
    async function generateSummary() {
        const summaryContent = document.getElementById('summaryContent');
        const loadingState = document.getElementById('loadingState');
        const errorState = document.getElementById('errorState');
        const generateBtn = document.getElementById('generateBtn');
        const clearBtn = document.getElementById('clearBtn');

        // Show loading state
        summaryContent.classList.add('hidden');
        errorState.classList.add('hidden');
        loadingState.classList.remove('hidden');
        generateBtn.disabled = true;

        try {
            const response = await fetch(
                '{{ route('freelancer.jobs.summarize', $jobListing) }}', {
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
            clearBtn.classList.remove('hidden');

            // Update button with icon
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
        // Split by double newlines to get sections
        const sections = summary.split('\n\n').filter(s => s.trim());

        let formattedHTML = '<div class="space-y-6">';

        sections.forEach((section, index) => {
            const lines = section.split('\n').map(l => l.trim()).filter(
                l => l);

            // Check if section starts with a numbered header (e.g., "1.", "2.", etc.)
            const headerMatch = lines[0].match(/^(\d+)\.\s*(.+)/);

            if (headerMatch) {
                // Section with numbered header
                const sectionNumber = headerMatch[1];
                const sectionTitle = headerMatch[2].replace(/\*\*/g,
                '');

                formattedHTML += `
                    <div class="card bg-base-200/50 shadow-sm border border-base-300">
                        <div class="card-body p-4">
                            <div class="flex items-start gap-3">
                                <div class="badge badge-primary badge-lg font-bold">${sectionNumber}</div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-lg mb-3 text-primary">${sectionTitle}</h3>
                `;

                // Process remaining lines in this section
                if (lines.length > 1) {
                    const content = lines.slice(1);
                    const hasBullets = content.some(line => line
                        .startsWith('-') || line.startsWith('•'));

                    if (hasBullets) {
                        formattedHTML += '<ul class="space-y-2">';
                        content.forEach(line => {
                            if (line.startsWith('-') || line
                                .startsWith('•')) {
                                const text = line.replace(
                                    /^[-•]\s*/, '').replace(
                                    /\*\*(.+?)\*\*/g,
                                    '<strong class="text-accent">$1</strong>'
                                    );
                                formattedHTML += `
                                    <li class="flex items-start gap-2">
                                        <svg class="h-5 w-5 text-primary mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-base-content/80">${text}</span>
                                    </li>
                                `;
                            } else if (line.trim()) {
                                formattedHTML +=
                                    `<p class="text-base-content/80 leading-relaxed">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
                            }
                        });
                        formattedHTML += '</ul>';
                    } else {
                        content.forEach(line => {
                            if (line.trim()) {
                                formattedHTML +=
                                    `<p class="text-base-content/80 leading-relaxed mb-2">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
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
                // Section without numbered header (overview/introduction)
                const hasBullets = lines.some(line => line.startsWith(
                    '-') || line.startsWith('•'));

                formattedHTML += '<div class="prose max-w-none">';

                if (hasBullets) {
                    lines.forEach(line => {
                        if (line.startsWith('-') || line
                            .startsWith('•')) {
                            if (!line.includes('<ul')) {
                                formattedHTML +=
                                    '<ul class="space-y-2 mt-2">';
                            }
                            const text = line.replace(
                                /^[-•]\s*/, '').replace(
                                /\*\*(.+?)\*\*/g,
                                '<strong class="text-accent">$1</strong>'
                                );
                            formattedHTML += `
                                <li class="flex items-start gap-2">
                                    <svg class="h-5 w-5 text-primary mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-base-content/80">${text}</span>
                                </li>
                            `;
                        } else if (line.trim()) {
                            formattedHTML +=
                                `<p class="text-base-content/80 leading-relaxed text-lg mb-3">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
                        }
                    });
                    formattedHTML += '</ul>';
                } else {
                    lines.forEach(line => {
                        if (line.trim()) {
                            formattedHTML +=
                                `<p class="text-base-content/80 leading-relaxed text-lg mb-3">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
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
            <div class="flex items-center gap-3 text-base-content/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Click "Generate Summary" to get an AI-powered overview of this job listing.</span>
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
