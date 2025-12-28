{{-- resources/views/partials/ai-profile-analysis.blade.php --}}
<div
    class="card bg-gradient-to-br from-primary/10 via-secondary/5 to-accent/10 shadow-2xl border-2 border-primary/30 hover:border-primary/50 transition-all duration-300">
    <div class="card-body">
        <!-- Enhanced Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="card-title text-2xl flex items-center gap-3">
                <span class="text-3xl animate-pulse">🤖</span>
                <span
                    class="bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent font-bold">
                    AI Profile Analysis
                </span>
            </h2>
            <div class="badge badge-primary badge-lg gap-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                AI-Powered
            </div>
        </div>

        <!-- Analysis Content -->
        <div id="analysisContent"
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
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-base-content mb-1">Ready to
                        Analyze</p>
                    <p class="text-sm text-base-content/60">Get AI-powered
                        insights about this profile</p>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div id="analysisLoading"
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
                    <p class="text-lg font-semibold text-base-content">Analyzing
                        Profile...</p>
                    <p class="text-sm text-base-content/60">Our AI is evaluating
                        credentials and trustworthiness</p>
                </div>
                <div class="flex gap-2">
                    <span
                        class="loading loading-dots loading-sm text-primary"></span>
                </div>
            </div>
        </div>

        <!-- Error State -->
        <div id="analysisError"
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
                    <h3 class="font-bold">Analysis Failed</h3>
                    <div class="text-xs"
                        id="analysisErrorMessage">Unable to analyze profile.
                        Please try again.</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card-actions justify-end mt-6 gap-3">
            <button onclick="analyzeProfile()"
                id="analyzeBtn"
                class="btn btn-primary gap-2 shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Analyze Profile
            </button>
            <button onclick="clearAnalysis()"
                id="clearAnalysisBtn"
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

        <!-- Info Tip -->
        <div class="mt-4 p-4 bg-warning/5 border border-warning/20 rounded-xl">
            <div class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-warning shrink-0 mt-0.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <p class="text-xs font-semibold text-warning mb-1">Important
                    </p>
                    <p class="text-xs text-base-content/70">AI analysis is for
                        reference only. Always conduct your own verification
                        before making decisions.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function analyzeProfile() {
        const analysisContent = document.getElementById('analysisContent');
        const analysisLoading = document.getElementById('analysisLoading');
        const analysisError = document.getElementById('analysisError');
        const analyzeBtn = document.getElementById('analyzeBtn');
        const clearAnalysisBtn = document.getElementById(
        'clearAnalysisBtn');

        // Show loading
        analysisContent.classList.add('hidden');
        analysisError.classList.add('hidden');
        analysisLoading.classList.remove('hidden');
        analyzeBtn.disabled = true;

        try {
            const response = await fetch(
                '{{ route('profile.analyze', $user->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Failed to analyze profile');
            }

            // Display analysis
            analysisContent.innerHTML = formatAnalysis(data.summary, data
                .trustScore);
            analysisContent.classList.remove('hidden');
            analysisContent.classList.add('animate-fade-in');
            clearAnalysisBtn.classList.remove('hidden');

            // Update button
            analyzeBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Re-analyze Profile
            `;

        } catch (error) {
            console.error('Error:', error);
            analysisError.classList.remove('hidden');
            document.getElementById('analysisErrorMessage').textContent =
                error.message;
            analysisContent.classList.remove('hidden');
        } finally {
            analysisLoading.classList.add('hidden');
            analyzeBtn.disabled = false;
        }
    }

    function formatAnalysis(summary, trustScore) {
        // Determine trust level and styling
        let trustLevel, trustColor, trustBg, trustIcon, trustBorder;

        if (trustScore >= 80) {
            trustLevel = 'Highly Trustworthy';
            trustColor = 'text-success';
            trustBg = 'bg-success/10';
            trustBorder = 'border-success/30';
            trustIcon = '✓';
        } else if (trustScore >= 60) {
            trustLevel = 'Generally Trustworthy';
            trustColor = 'text-info';
            trustBg = 'bg-info/10';
            trustBorder = 'border-info/30';
            trustIcon = '✓';
        } else if (trustScore >= 40) {
            trustLevel = 'Moderate Trust';
            trustColor = 'text-warning';
            trustBg = 'bg-warning/10';
            trustBorder = 'border-warning/30';
            trustIcon = '!';
        } else {
            trustLevel = 'Exercise Caution';
            trustColor = 'text-error';
            trustBg = 'bg-error/10';
            trustBorder = 'border-error/30';
            trustIcon = '⚠';
        }

        let html = '<div class="space-y-5 animate-fade-in">';

        // Trust Score Card
        html += `
            <div class="card ${trustBg} border-2 ${trustBorder} shadow-lg">
                <div class="card-body p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="radial-progress ${trustColor}" style="--value:${trustScore}; --size:5rem; --thickness: 0.4rem;">
                                <span class="text-2xl font-bold">${trustScore}</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold ${trustColor} mb-1">${trustLevel}</h3>
                                <p class="text-sm text-base-content/70">Trust Score out of 100</p>
                            </div>
                        </div>
                        <div class="text-5xl ${trustColor}">${trustIcon}</div>
                    </div>
                </div>
            </div>
        `;

        // Profile Summary
        const sections = summary.split('\n\n').filter(s => s.trim());

        sections.forEach((section) => {
            const lines = section.split('\n').map(l => l.trim()).filter(
                l => l);
            const headerMatch = lines[0].match(/^(\d+)\.\s*(.+)/);

            if (headerMatch) {
                const sectionNumber = headerMatch[1];
                const sectionTitle = headerMatch[2].replace(/\*\*/g,
                '');

                html += `
                    <div class="card bg-gradient-to-br from-base-200/80 to-base-300/30 shadow-lg border-l-4 border-primary hover:shadow-xl transition-all duration-300">
                        <div class="card-body p-5">
                            <div class="flex items-start gap-4">
                                <div class="badge badge-primary badge-lg font-bold text-lg px-3 py-4">${sectionNumber}</div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl mb-4 text-primary">${sectionTitle}</h3>
                `;

                if (lines.length > 1) {
                    const content = lines.slice(1);
                    const hasBullets = content.some(line =>
                        line.startsWith('-') || line.startsWith(
                        '•') || line.startsWith('*')
                    );

                    if (hasBullets) {
                        html += '<ul class="space-y-3">';
                        content.forEach(line => {
                            if (line.startsWith('-') || line
                                .startsWith('•') || line
                                .startsWith('*')) {
                                const text = line.replace(
                                        /^[-•*]\s*/, '')
                                    .replace(
                                        /\*\*(.+?)\*\*/g,
                                        '<strong class="text-accent">$1</strong>'
                                    );
                                html += `
                                    <li class="flex items-start gap-3">
                                        <div class="bg-primary/10 p-1.5 rounded-lg mt-0.5">
                                            <svg class="h-4 w-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <span class="text-base-content/90 leading-relaxed flex-1">${text}</span>
                                    </li>
                                `;
                            }
                        });
                        html += '</ul>';
                    }
                }

                html += `
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                html +=
                    '<div class="prose max-w-none bg-base-200/30 p-5 rounded-xl border border-base-300">';
                lines.forEach(line => {
                    if (line.trim()) {
                        html +=
                            `<p class="text-base-content/90 leading-relaxed mb-3">${line.replace(/\*\*(.+?)\*\*/g, '<strong class="text-accent">$1</strong>')}</p>`;
                    }
                });
                html += '</div>';
            }
        });

        html += '</div>';
        return html;
    }

    function clearAnalysis() {
        const analysisContent = document.getElementById('analysisContent');
        const clearAnalysisBtn = document.getElementById('clearAnalysisBtn');
        const analyzeBtn = document.getElementById('analyzeBtn');

        analysisContent.innerHTML = `
            <div class="flex flex-col items-center justify-center gap-4 p-8 bg-base-200/50 rounded-xl border-2 border-dashed border-base-300">
                <div class="bg-primary/10 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-base-content mb-1">Ready to Analyze</p>
                    <p class="text-sm text-base-content/60">Get AI-powered insights about this profile</p>
                </div>
            </div>
        `;

        clearAnalysisBtn.classList.add('hidden');
        analyzeBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            Analyze Profile
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
