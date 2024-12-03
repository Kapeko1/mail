
    <div class="flex h-screen bg-gray-900 text-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 p-4">
            <button type="button"
                    wire:click="toggleComposePopup" @click.prevent
                class="w-full mb-4 inline-flex items-center justify-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Email
            </button>
            <nav>
                @foreach(['inbox', 'sent', 'starred', 'archive', 'trash'] as $tag)
                    <button
                        class="w-full justify-start mb-1 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                        wire:click="$set('selectedTag', '{{ $tag }}')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        {{ ucfirst($tag) }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-gray-800 p-4 flex items-center justify-between border-blue-500 border-b-2">
                <div class="flex items-center bg-gray-700 rounded-md w-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Search mail" class="bg-transparent border-none focus:ring-0 focus:ring-offset-0 text-gray-100 placeholder-gray-400 w-full" />
                </div>

            </div>

            <!-- Email List -->
            <div class="flex-1 overflow-auto">
                @foreach([
                    ['id' => 1, 'from' => 'John Doe', 'subject' => 'Project Update', 'preview' => 'Hey, I wanted to give you a quick update on the...', 'time' => '10:30 AM'],
                    ['id' => 2, 'from' => 'Jane Smith', 'subject' => 'Meeting Tomorrow', 'preview' => 'Just a reminder that we have a team meeting scheduled for...', 'time' => 'Yesterday'],
                    ['id' => 3, 'from' => 'Bob Johnson', 'subject' => 'Question about the report', 'preview' => 'I was looking at the quarterly report and had a question about...', 'time' => 'Yesterday'],
                    ['id' => 4, 'from' => 'Alice Brown', 'subject' => 'Vacation Plans', 'preview' => 'Im planning my vacation for next month and wanted to check if...', 'time' => 'Mon'],
                    ['id' => 5, 'from' => 'Charlie Wilson', 'subject' => 'New Project Proposal', 'preview' => 'I    ve attached a proposal for a new project that I think would be...', 'time' => 'Sun']
                ] as $email)
                    <div class="p-4 border-b border-gray-700 hover:bg-gray-800">
                        <div class="flex justify-between items-start mb-1">
                            <span class="font-semibold">{{ $email['from'] }}</span>
                            <span class="text-sm text-gray-400">{{ $email['time'] }}</span>
                        </div>
                        <div class="text-sm font-medium mb-1">{{ $email['subject'] }}</div>
                        <div class="text-sm text-gray-400">{{ $email['preview'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        @if($showComposePopup)
            <div x-data="{ showPopup: false }"
                 x-init="setTimeout(() => showPopup = true, 0)"
                 x-show="showPopup"
                 x-transition:enter="transition-opacity duration-300 ease-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-300 ease-in"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

                <div id="compose-popup"
                     class="bg-gray-800 rounded-lg shadow-xl w-3/4 h-3/4 flex flex-col overflow-hidden"
                     style="min-width: 300px; min-height: 400px;">
                    <div class="flex items-center justify-between p-4 border-b border-gray-700">
                        <h2 class="text-lg font-semibold">New Email</h2>
                        <!-- Close Button -->
                        <button type="button"
                                @click="showPopup = false; $wire.toggleComposePopup()"
                                class="text-gray-400 hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 p-4 overflow-auto">
                        <input type="text" placeholder="To" class="w-full bg-gray-700 text-gray-100 rounded-md p-2 mb-2">
                        <input type="text" placeholder="Subject" class="w-full bg-gray-700 text-gray-100 rounded-md p-2 mb-2">
                        <textarea rows="10" class="w-full bg-gray-700 text-gray-100 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Compose your email..."></textarea>
                    </div>
                    <div class="p-4 border-t border-gray-700">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Send
                        </button>
                    </div>
                </div>
            </div>

        @endif
    </div>

