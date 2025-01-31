@props(['role' => ''])
@php
$list = [
  'Élève' => ["Élève", "bg-primary-50"],
  'Initiateur' => ["Initiateur","bg-alert-success-100"],
  'Responsable de formation' => ["Initiateur","bg-alert-success-100"],
  'Directeur Technique' => ["Initiateur","bg-alert-success-100"],
];

$value = $list[$role] ?? "bg-primary-50";

@endphp

<div class="flex flex-row min-h-8 min-w-28 rounded-full {{ $value[1] }} justify-center items-center px-2">
  <h1 class="text-normalText font-poppinsRegular">{{ $value[0] }}</h1>
</div>