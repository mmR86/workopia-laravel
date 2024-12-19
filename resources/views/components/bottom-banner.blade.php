@props([
    'title' => 'Looking to hire?',
    'subtitle' => 'Post your job listing now and find the perfect candidate.'
    ])

<section class="container mx-auto my-6">
    <div
      class="bg-blue-800 text-white rounded p-4 flex items-center justify-between"
    >
      <div>
        <h2 class="text-xl font-semibold">{{$title}}</h2>
        <p class="text-gray-200 text-lg mt-2">{{$subtitle}}</p>
      </div>
      <x-button-link url="/jobs/create" icon="edit">
        Create Job
      </x-button-link>
    </div>
  </section>