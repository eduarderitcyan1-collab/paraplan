@include('admin.blocks._form', ['block' => $block, 'page' => $page, 'action' => route('admin.pages.blocks.update', [$page, $block]), 'method' => 'PUT'])
