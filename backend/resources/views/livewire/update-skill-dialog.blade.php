<div x-data="{ open: @entangle('isOpen') }">
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-cards  flex flex-col gap-4 max-w-[600px] w-[600px]">
            <input type="text" wire:model="skillLabel" class="rounded-cards px-4 py-2 border-background-300 border-2  w-full text-h4 text-center" placeholder="Nom de la compétence">

            <div class="w-full flex flex-col items-center bg-background-200 p-4 rounded-cards gap-4">
                <div class="font-poppinsSemiBold">Aptitudes</div>
                <div class="overflow-y-scroll  w-full bg-background-200 flex flex-col gap-1">
                    @foreach ($tempABilitiesToRemove as $index => $ability )
                    <div class="flex justify-between items-center border bg-red-50 text-background-300 rounded-cards px-2">
                        <span class="overflow-hidden">{{ $ability['abil_label'] }}</span>
                        <button wire:click="cancelRemoveAbility({{$index }})" class="text-alert-danger ml-2">
                            &#x21bb;
                        </button>
                    </div>
                    @endforeach

                    @foreach($skillAbilities as $index => $ability)
                        <div class="flex justify-between items-center border bg-blue-50 rounded-cards px-2">
                            <span class="overflow-hidden">{{ $ability['abil_label'] }}</span>
                            <button wire:click="removeAbility({{$index}})" class="text-alert-danger ml-2">
                                &times;
                            </button>
                            
                        </div>
                    @endforeach
                        
                    @foreach ($tempAbilitiesLabelToAdd as $index => $newAbilityLabel )
                    <div class="flex justify-between items-center border bg-green-50 rounded-cards px-2">
                        <span class="overflow-hidden">{{ $newAbilityLabel }}</span>
                        <button wire:click="removeTempAbilityLabel({{ $index }})" class="text-alert-danger ml-2">
                            &times;
                        </button>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="flex gap-2">
                <input type="text" wire:model="abilityLabel" class="rounded-cards px-4 border-background-300 border-2  w-full text-h4 text-center" placeholder="Nouvelle capacité">
                <button wire:click="addAbility" class="bg-primary-100 text-white px-4 py-2 rounded-cards">Ajouter</button>
            </div>
            <hr>
            <div class="w-full flex h-full flex-row justify-between gap-2">
                <button wire:click="close" class="bg-background-300 text-white px-4 py-2 rounded-cards">Annuler</button>
                <div class="flex flex-row gap-2">
                    <button wire:click="deleteSkill" class="bg-alert-danger text-white px-4 py-2 rounded-cards">Supprimer la compétence</button>
                    <button wire:click="saveSkill" class="bg-alert-success-100 text-white px-4 py-2 rounded-cards ">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>