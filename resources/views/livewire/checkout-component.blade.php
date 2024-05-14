<div>
    <script>
        window.logToConsole = function(data) {
            console.log(data);
        }
    </script>
    <div class="py-8">
        <div class="flex flex-col gap-2">

            <div>
                    <div class="mb-4">
                        <div class="w-full h-[4rem] flex flex-row gap-4">
                            <div class="w-[6rem] h-full rounded-[1rem] border flex items-center justify-center border-customBlue transition-all ease-in-out duration-150 hover:border-2 cursor-pointer">
                                <x-heroicon-o-credit-card class="text-customBlue w-6 h-6" />
                            </div>
                            <div>
                                <div class="flex flex-grow items-center h-full rounded-[1rem] border border-[#282727] p-4 group-hover:border">
                                        <div class="flex justify-between w-full items-center">
                                            <h1 class="font-normal">Mache jetzt den letzten Schritt um deine Anzeige Online zu stellen!</h1>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-grow h-px bg-[#282727] mb-[1rem]"></div>
            </div>

            @foreach ($jobPosts as $jobPost)
            <div wire:click="selectJobPost({{ $jobPost->id }})" class="w-full h-[4rem] flex flex-row gap-4">
                <div wire:click="openModal" class="w-[6rem] h-full rounded-[1rem] border border-[#525151] flex items-center justify-center group hover:border-customBlue transition-all ease-in-out duration-150 hover:border-2 cursor-pointer">
                    <x-heroicon-o-shopping-cart class="group-hover:text-customBlue text-[#525151] w-6 h-6" />
                </div>

                <div class="flex w-full rounded-[1rem] bg-[#282727] p-4 group-hover:border border-customBlue">
                    <div class="flex w-full">
                        <div class="flex justify-between w-full items-center">
                            <h1 class="font-normal line-clamp-2">{{ $jobPost->title }}</h1>
                                <div class="ml-2">
                                    @if ($jobPost->type === 'job')
                                        <div class="px-3 py-1 border border-customBlue rounded-lg bg-customBlue bg-opacity-10 font-light text-[0.8rem] text-customBlueDarker">Job</div>
                                    @elseif ($jobPost->type === 'intern')
                                        <div class="px-3 py-1 border border-customBrown rounded-lg bg-customBrown bg-opacity-10 font-light text-[0.8rem] text-customBrownDarker">Praktikum</div>
                                    @endif
                                </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    @vite('resources/css/app.css')


    @if($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto opacity-100 visible transition-opacity duration-300" style="display: block;">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-black opacity-35"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>


                <div class="mx-4 inline-block items-end bg-[#282727] rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">

                    <div class="p-8">
                        <div class="flex items-center justify-center w-full h-[2rem] mb-4 text-[0.9rem] md:text-[1rem]">
                            <a class="cursor-pointer underline" href="/dashboard/{{ $tenantSlug }}/pricing">Für mehr infos zu den Plänen hier klicken</a>
                        </div>
                        @foreach ($paymentPlans as $plan)
                            <div wire:click="selectPaymentPlan({{ $plan->id }})" wire:click="redirectToCheckout" wire:click="redirectToCheckout()" class="mb-4 cursor-pointer hover:border-2 flex flex-row justify-start items-center px-4 py-2 w-full h-[5rem] bg-black bg-opacity">

                            <p class="flex font-semibold text-[1.4rem] md:text-[2rem]">€{{ $plan->price }}</p>
                                <p class="font-medium text-[1.6rem] md:text-[2.2rem] ml-4">{{ $plan->name }}</p>
                                <x-heroicon-o-shopping-cart class="text-customBlue w-8 h-8 ml-auto mr-2" />
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-[#282727] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="closeModal" type="button" class="w-full inline-flex justify-center rounded-xl border-2 border-customBlue shadow-sm px-4 py-2 bg-transparent hover:bg-customBlue text-base font-semibold text-customBlue hover:text-white focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Close
                        </button>
                    </div>
                </div>


            </div>
        </div>
        @else
        <div class="fixed z-10 inset-0 overflow-y-auto opacity-0 invisible transition-opacity duration-300" style="display: block;">
            <!-- Rest of the modal code -->
        </div>
    @endif
</div>
