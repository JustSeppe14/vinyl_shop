<x-vinylshop-layout>
    <x-slot name="title">Playground</x-slot>
    <h2>Sections</h2>
    <div class="grid grid-cols-3 gap-4">
        <x-tmk.section class="col-span-3 md:col-span-1">
            <h3>Section 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi ducimus fuga nesciunt nisi quo sequi
                voluptas. Accusantium consequuntur officiis veritatis.</p>
        </x-tmk.section>
        <x-tmk.section class="col-span-3 md:col-span-1">
            <h3>Section 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab distinctio eos ex excepturi possimus, reprehenderit vitae voluptatum. Accusamus eius eum ex, explicabo illo iste maxime odio soluta, vero voluptas, voluptate!</p>
        </x-tmk.section>
        <x-tmk.section class="col-span-3 md:col-span-1">
            <h3>Section 3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, quasi?</p>
        </x-tmk.section>
    </div>
    <section class="my-4">
        <h2>Blade UI kit Icons</h2>
        <div class="flex gap-4 p-4 my-4 bg-white rounded border shadow">
            <div class="w-6">
                <x-fas-home/>
            </div>
            <div class="w-6 text-orange-600">
                <x-icon name="fas-home"/>
            </div>
            <div class="w-6 text-green-600">
                @svg('fas-home')
            </div>
            <div class="w-6 text-sky-600">
                {{svg('fas-home')}}
            </div>
        </div>
    </section>
</x-vinylshop-layout>
