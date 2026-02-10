@include('admin.partials.layout-start')
<div class="mb-4 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Блоки контента</h1>
    <a href="{{ route('admin.blocks.create') }}" class="rounded bg-indigo-600 px-4 py-2 text-white">Создать блок</a>
</div>
@include('admin.partials.flash')
<ul id="sortable-blocks" class="space-y-3">
@foreach($blocks as $block)
    <li draggable="true" data-id="{{ $block->id }}" class="rounded bg-white p-4 shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="font-semibold">{{ $block->name }} <span class="text-xs text-gray-500">({{ $block->code }})</span></div>
                <div class="text-sm text-gray-500">Элементов: {{ $block->items_count }} · Порядок: {{ $block->display_order }}</div>
            </div>
            <div class="space-x-2 text-sm">
                <a href="{{ route('admin.blocks.items.index', $block) }}" class="text-blue-600">Элементы</a>
                <a href="{{ route('admin.blocks.edit', $block) }}" class="text-amber-600">Ред.</a>
                <form method="POST" action="{{ route('admin.blocks.destroy', $block) }}" class="inline">@csrf @method('DELETE')<button class="text-red-600" onclick="return confirm('Удалить блок?')">Удалить</button></form>
            </div>
        </div>
    </li>
@endforeach
</ul>
<button id="save-order" class="mt-4 rounded bg-emerald-600 px-4 py-2 text-white">Сохранить порядок блоков</button>
<div class="mt-4">{{ $blocks->links() }}</div>
<script>
const list=document.getElementById('sortable-blocks');let dragItem=null;
list.querySelectorAll('li').forEach(item=>{item.addEventListener('dragstart',()=>dragItem=item);item.addEventListener('dragover',e=>e.preventDefault());item.addEventListener('drop',e=>{e.preventDefault();if(dragItem&&dragItem!==item){const rect=item.getBoundingClientRect();const next=(e.clientY-rect.top)>(rect.height/2);item.parentNode.insertBefore(dragItem,next?item.nextSibling:item);}});});
document.getElementById('save-order').addEventListener('click',async()=>{const ordered_ids=[...list.querySelectorAll('li')].map(li=>Number(li.dataset.id));const res=await fetch('{{ route('admin.blocks.reorder') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({ordered_ids})});alert(res.ok?'Сохранено':'Ошибка');if(res.ok)location.reload();});
</script>
@include('admin.partials.layout-end')
