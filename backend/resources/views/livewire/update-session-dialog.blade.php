<div x-data="{ open: @entangle('isOpen') }" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-8 rounded-lg shadow-md w-2/3 relative">
            <button @click="open = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            @if($session)
            <div class="mb-4">
                <label for="sessionDate" class="block text-sm text-gray-700">Date de la séance</label>
                <input type="datetime-local" id="sessionDate" wire:model="sessionDate"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-blue-500">
                @error('sessionDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-700">Assignation des élèves</label>
                <table class="w-full border border-gray-300 rounded-md">
                    <thead>
                        <tr>
                            <th class="p-2 border-b">Élève</th>
                            <th class="p-2 border-b">Initiateur</th>
                            <th class="p-2 border-b">Aptitudes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="p-2">

                        </td>
                        @foreach($assignedStudents as $index => $student)
                            <tr class="border-b">
                                <td class="p-2">
                                    <select wire:model="assignedStudents.{{ $index }}.student_id" class="border p-2 rounded w-full " 
                                    @if($student['student_id']) disabled @endif>
                                    @foreach($selectedAttendees as $attendee)
                                        <option class="readonly" value="{{ $attendee['user_id'] }}" {{ $student['student_id'] == $attendee['user_id'] ? 'selected' : '' }}>
                                            {{ $attendee['user_firstname'] }} {{ strtoupper($attendee['user_lastname']) }}
                                        </option>
                                    @endforeach
                                </select>
                                </td>
                                <td class="p-2">
                                    @foreach($selectedInitiators as $initiator)
                                        <p>{{ $initiator['user_id']}}
                                    @endforeach
                                </td>
                                <td class="p-2">
                                    <div class="flex flex-col space-y-2">
                                        @foreach($student['abilities'] as $abilityIndex => $ability)
                                            <select wire:model="assignedStudents.{{ $index }}.abilities.{{ $abilityIndex }}" class="border p-2 rounded w-full">
                                                <option value="">Choisir une aptitude</option>
                                                @foreach($abilities as $abil)
                                                    <option value="{{ $abil['abil_id'] }}" {{ $ability == $abil['abil_id'] ? 'selected' : '' }}>
                                                        {{ $abil['abil_label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button wire:click="deleteSession('{{ $session['sess_id'] }}')" class="bg-red-500 text-white px-4 py-2 rounded">
                    Supprimer
                </button>
                <button wire:click="updateSession('{{ $session['sess_id'] }}')" class="bg-green-500 text-white px-4 py-2 rounded">
                    Mettre à jour
                </button>
            </div>
            @endif
        </div>
    </div>
</div>