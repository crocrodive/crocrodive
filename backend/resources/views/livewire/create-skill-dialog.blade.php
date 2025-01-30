<div x-data="{ open: @entangle('isOpen') }">
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-8 w-[400px] flex flex-col gap-4 items-center rounded-cards">
            <div class="text-h4 font-poppinsSemiBold ">Ajouter une compétence</div>
            <input type="text" wire:model="skillLabel" class="rounded-cards px-4 border-background-300 border-2  w-full text-h4 text-center" placeholder="Nom de la compétence">
            <div class="flex w-full justify-end gap-4">
                <button @click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded-cards ml-2">Annuler</button>
                <button wire:click="saveSkill" class="bg-blue-500 text-white px-4 py-2 rounded-cards">Enregistrer</button>
            </div>
        </div>
    </div>
</div>