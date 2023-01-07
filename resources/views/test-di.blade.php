<x-base>
    <h2>DIテスト</h2>

    <form action="{{ route('di') }}" method="post">
        @csrf
        <input type="text" name="message" id="message">
        <button>submit</button>
    </form>
</x-base>
