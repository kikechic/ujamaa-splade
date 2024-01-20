<footer class="block h-16 max-h-[4rem] py-2 print:hidden">
    <div class="container px-4 mx-auto">
        <hr class="mb-2 border-b-1 border-slate-200" />
        <div class="flex flex-wrap items-center justify-center md:justify-between">
            <div class="w-full px-2 md:w-full">
                <div
                    class="flex justify-between w-full py-1 text-sm font-semibold text-center text-slate-500 md:text-left">
                    <div>
                        Developed by
                        <a class="py-1 text-sm font-semibold text-primary-500 hover:text-primary-700"
                            href="mailto:kikechithomas@gmail.com" target="_blank">
                            Thomas Kikechi
                        </a>
                    </div>
                    <div class="text-right">
                        Copyright ©
                        <span id="get-current-year">
                            {{ now()->format('Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
