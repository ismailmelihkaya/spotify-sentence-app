<div>
    <div class="p-4">
        <input wire:model="sentence" type="text" class="w-full p-2 border rounded" placeholder="Bir cümle yaz...">

        <button wire:click="searchSongs" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Şarkı Ara</button>

        @if ($songs)
            <div class="mt-4">
                @foreach ($songs as $song)
                    <div class="border-b py-2">
                        <strong>{{ $song['name'] }}</strong> - {{ $song['artist'] }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
