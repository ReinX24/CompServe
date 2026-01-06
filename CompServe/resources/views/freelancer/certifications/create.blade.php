<x-layouts.app>
    <!-- Breadcrumbs with Enhanced Styling -->
    <div class="breadcrumbs text-sm mb-6">
        <ul class="text-base-content/70">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-primary transition-colors duration-200 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('freelancer.certifications.index') }}"
                    class="hover:text-primary transition-colors duration-200">
                    My Certifications
                </a>
            </li>
            <li class="text-primary font-semibold">Apply for Certification</li>
        </ul>
    </div>

    <!-- Hero Header with Gradient Background -->
    <div
        class="relative overflow-hidden bg-linear-to-br from-primary/10 via-secondary/5 to-accent/10 rounded-2xl shadow-xl mb-8 border border-base-300/50">
        <!-- Decorative Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-40 h-40 bg-primary rounded-full blur-3xl">
            </div>
            <div
                class="absolute bottom-0 right-0 w-60 h-60 bg-secondary rounded-full blur-3xl">
            </div>
        </div>

        <div class="relative p-8 md:p-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1
                    class="text-4xl md:text-5xl font-bold text-base-content mb-3 flex items-center justify-center gap-3">
                    <span class="text-5xl">📝</span>
                    Apply for Certifications
                </h1>
                <p class="text-base md:text-lg text-base-content/70">
                    Submit multiple certifications at once to enhance your
                    professional profile ✨
                </p>
            </div>
        </div>
    </div>

    {{-- GLOBAL ERROR ALERT --}}
    @if ($errors->any())
        <div class="mb-6 animate-fade-in">
            <div role="alert"
                class="alert bg-error/10 border-error/30 text-error shadow-lg rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <div class="bg-error/20 p-2 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold block mb-2">There were some
                            issues with your submission:</span>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="max-w-4xl mx-auto">
        <div
            class="card bg-base-100 shadow-xl border border-base-300/50 animate-fade-in-up">
            <div class="card-body p-8">

                <form action="{{ route('freelancer.certifications.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="certificationForm"
                    class="space-y-6">
                    @csrf

                    <!-- Certifications Container -->
                    <div id="certificationsContainer"
                        class="space-y-8">
                        <!-- First Certification (Template) -->
                        <div
                            class="certification-item border-2 border-primary/20 rounded-2xl p-6 bg-base-200/50 relative">
                            <div class="flex justify-between items-center mb-4">
                                <h3
                                    class="text-xl font-bold text-primary flex items-center gap-2">
                                    <span class="text-2xl">📜</span>
                                    Certification #<span
                                        class="cert-number">1</span>
                                </h3>
                                <button type="button"
                                    class="btn btn-sm btn-ghost btn-circle remove-cert hidden"
                                    title="Remove this certification">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Certification Type -->
                            <div class="form-control space-y-3 mb-4">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold text-lg flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd"
                                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Certification Type
                                    </span>
                                    <span
                                        class="label-text-alt text-error">*Required</span>
                                </label>
                                <select name="certifications[0][type]"
                                    class="cert-type select select-bordered w-full select-lg focus:select-primary transition-all duration-200"
                                    required>
                                    <option value="">Select Certification
                                    </option>
                                    <optgroup
                                        label="TESDA National Certificates">
                                        <option value="NC I">NC I</option>
                                        <option value="NC II">NC II</option>
                                        <option value="NC III">NC III</option>
                                        <option value="NC IV">NC IV</option>
                                    </optgroup>
                                    <optgroup label="IT & Tech Certifications">
                                        <option value="CompTIA A+">CompTIA A+
                                        </option>
                                        <option value="CompTIA Network+">CompTIA
                                            Network+</option>
                                        <option value="CompTIA Security+">
                                            CompTIA Security+</option>
                                        <option value="Cisco CCNA">Cisco CCNA
                                        </option>
                                        <option value="AWS Solutions Architect">
                                            AWS Solutions Architect</option>
                                    </optgroup>
                                    <option value="other">Other (Specify below)
                                    </option>
                                </select>
                            </div>

                            <!-- Custom Certification Name -->
                            <div class="form-control space-y-3 mb-4 custom-cert-field"
                                style="display: none;">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold text-lg">Certification
                                        Name</span>
                                    <span
                                        class="label-text-alt text-error">*Required</span>
                                </label>
                                <input type="text"
                                    name="certifications[0][custom_certification]"
                                    class="custom-cert-input input input-bordered w-full input-lg"
                                    placeholder="Enter certification name">
                            </div>

                            <!-- Description -->
                            <div class="form-control space-y-3 mb-4">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold">Description</span>
                                    <span
                                        class="label-text-alt text-base-content/60">Optional</span>
                                </label>
                                <textarea name="certifications[0][description]"
                                    class="textarea textarea-bordered w-full h-24"
                                    placeholder="Add details about your certification"></textarea>
                            </div>

                            <!-- Upload Document -->
                            <div class="form-control space-y-3">
                                <label class="label">
                                    <span
                                        class="label-text font-semibold flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-primary"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Upload Document
                                    </span>
                                    <span
                                        class="label-text-alt text-error">*Required</span>
                                </label>
                                <input type="file"
                                    name="certifications[0][document]"
                                    class="file-input file-input-bordered file-input-primary w-full"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    required>
                                <p class="text-xs text-base-content/60">PDF,
                                    JPG, PNG (Max 5MB)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Add More Button -->
                    <div class="flex justify-center pt-4">
                        <button type="button"
                            id="addCertification"
                            class="btn btn-outline btn-primary gap-2 hover:scale-105 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add Another Certification
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 border-t-2 border-base-300">
                        <button type="submit"
                            class="btn btn-primary btn-lg w-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit <span id="certCount">1</span>
                            Certification(s)
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
    </style>

    <script>
        let certificationCount = 1;

        document.getElementById('addCertification').addEventListener('click',
            function() {
                const container = document.getElementById(
                    'certificationsContainer');
                const template = container.querySelector('.certification-item')
                    .cloneNode(true);

                // Update certification number
                certificationCount++;
                template.querySelector('.cert-number').textContent =
                    certificationCount;

                // Update input names with new index
                const inputs = template.querySelectorAll(
                    'input, select, textarea');
                inputs.forEach(input => {
                    if (input.name) {
                        input.name = input.name.replace('[0]',
                            `[${certificationCount - 1}]`);
                    }
                    // Clear values
                    if (input.type === 'file') {
                        input.value = '';
                    } else if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                    } else {
                        input.value = '';
                    }
                });

                // Show remove button
                template.querySelector('.remove-cert').classList.remove(
                    'hidden');

                // Hide custom field by default
                template.querySelector('.custom-cert-field').style.display =
                    'none';

                // Add to container
                container.appendChild(template);

                // Update count
                updateCertCount();

                // Scroll to new item
                template.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });

        // Event delegation for remove buttons
        document.getElementById('certificationsContainer').addEventListener('click',
            function(e) {
                if (e.target.closest('.remove-cert')) {
                    if (certificationCount > 1) {
                        e.target.closest('.certification-item').remove();
                        certificationCount--;
                        updateCertCount();
                        updateCertNumbers();
                    }
                }
            });

        // Event delegation for cert type changes
        document.getElementById('certificationsContainer').addEventListener(
            'change',
            function(e) {
                if (e.target.classList.contains('cert-type')) {
                    const certItem = e.target.closest('.certification-item');
                    const customField = certItem.querySelector(
                        '.custom-cert-field');
                    const customInput = certItem.querySelector(
                        '.custom-cert-input');

                    if (e.target.value === 'other') {
                        customField.style.display = 'block';
                        customInput.required = true;
                    } else {
                        customField.style.display = 'none';
                        customInput.required = false;
                        customInput.value = '';
                    }
                }
            });

        function updateCertCount() {
            document.getElementById('certCount').textContent = certificationCount;
        }

        function updateCertNumbers() {
            document.querySelectorAll('.cert-number').forEach((el, index) => {
                el.textContent = index + 1;
            });
        }
    </script>
</x-layouts.app>
