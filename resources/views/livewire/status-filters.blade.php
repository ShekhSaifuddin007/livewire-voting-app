<nav class="hidden md:flex items-center justify-between text-xs">
    <ul class="flex uppercase font-semibold border-b-4 border-gray-300 pb-3 space-x-10">
        <li>
            <a
                wire:click.prevent="setStatus('all')"
                href="#"
                class="border-b-4 {{ $status === 'all' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                All Ideas ({{ $statusCount['all_statuses'] }})
            </a>
        </li>
        <li>
            <a
                wire:click.prevent="setStatus('considering')"
                href="#"
                class="border-b-4 {{ $status === 'considering' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                Considering ({{ $statusCount['considering'] }})
            </a>
        </li>
        <li>
            <a
                wire:click.prevent="setStatus('progress')"
                href="#"
                class="border-b-4 {{ $status === 'progress' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                In Progress ({{ $statusCount['in_progress'] }})
            </a>
        </li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 border-gray-300 pb-3 space-x-10">
        <li>
            <a
                wire:click.prevent="setStatus('open')"
                href="#"
                class="border-b-4 {{ $status === 'open' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                Open ({{ $statusCount['open'] }})
            </a>
        </li>
        <li>
            <a
                wire:click.prevent="setStatus('implemented')"
                href="#"
                class="border-b-4 {{ $status === 'implemented' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                Implemented ({{ $statusCount['implemented'] }})
            </a>
        </li>
        <li>
            <a
                wire:click.prevent="setStatus('closed')"
                href="#"
                class="border-b-4 {{ $status === 'closed' ? 'border-teal-500' : 'text-gray-400 border-gray-300 hover:border-teal-500 transition duration-150 ease-in' }} pb-3"
            >
                Closed ({{ $statusCount['closed'] }})
            </a>
        </li>
    </ul>
</nav>
