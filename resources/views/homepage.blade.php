<x-app-layout>
    
    <div class="bg-blue-500 bg-opacity-75">
            <div class="flex flex-col leading-loose mx-auto text-white w-4/5" style="">
                <h1 class="font-bold pt-10 text-7xl">
                    Connecting the World's<br>Motivated Buyers &amp; Sellers
                </h1>

                <x-frontend.homepage-search></x-frontend.homepage-search>

                <div class="w-full flex flex-row justify-around py-2 text-2xl w-2/3">
                    <div><a href="#">UPCOMING EVENTS</a></div>
                    <div><a href="#">NEW EVENTS</a></div>
                    <div><a class="map-search hide-later" href="#">ADVANCED SEARCH</a></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-200">
        <div class="mx-auto pb-20 w-4/5">
            <h2 class="font-bold py-10 text-3xl text-realty text-center">Or browse by category:</h2>
            <div class="flex justify-around pt-5">
                
                    <x-frontend.category-search>
                        <a href="#">
                            <img src="https://www.realtyhive.com/images/icons/Icons_Residential.png">
                            <div class="pt-2">Residential</div>
                        </a>
                    </x-frontend.category-search>

                    <x-frontend.category-search>
                        <a href="#">
                            <img src="https://www.realtyhive.com/images/icons/Icons_Commercial.png">
                            <div class="pt-2">Commercial</div>
                        </a>
                    </x-frontend.category-search>

                    <x-frontend.category-search>
                        <a href="#">
                            <img src="https://www.realtyhive.com/images/icons/Icons_Land.png">
                            <div class="pt-2">Vacant Land</div>
                        </a>
                    </x-frontend.category-search>

                    <x-frontend.category-search>
                        <a href="#">
                            <img src="https://www.realtyhive.com/images/icons/Icons_Multifamily.png">
                            <div class="pt-2">Multi-Family</div>
                        </a>
                    </x-frontend.category-search>
            </div>
        </div>
    </div>

    <div>
        <div class="pt-10 text-center">
            <h4 class="font-bold text-6xl text-realty">From overwhelmed to <br> stress-free selling</h4>
        </div>

        <x-frontend.home-section>
            <div class="w-1/2"><img src="https://www.realtyhive.com/images/homepage/NewHomepage/stress-free.png"></div>
            <div class="leading-loose px-3 py-5 w-1/2">
                <div>
                    <h1 class="font-bold text-realty uppercase">We do the hard work for you</h1>
                    <h2 class="font-bold py-5 text-2xl">If you're not getting any offers and you have no idea what's happening to your property</h2>
                    <h3>Get automated, world-class marketing on top of your agent's local expertise with worry-free option of ZERO fees if your property doesn't sell. <br><br>
                    You also get instant updates and the ability to check on the activity on your personalized property dashboard.</h3><br>
                    <a href="#" class="font-bold text-realty">Add my property<span></span></a>
                </div>
            </div>
        </x-frontend.home-section>

        <x-frontend.home-section>
            <div class="px-3 w-1/2">
                <div class="leading-loose py-5">
                    <h1 class="font-bold text-realty uppercase">Seal the deal with 2,500% more daily views</h1>
                    <h2 class="font-bold py-5 text-2xl">If it feels like everyone else's home is selling before yours</h2>
                    <h3>Time-Limited Events create a sense of urgency and puts your property in the premier position to attract buyers from all over the globe.<br><br>
                    Whether you're currently working with an agent or want to sell on your own, our customized programs will cater to your needs.</h3><br>
                    <a href="#" class="font-bold text-realty">Get started<span></span></a>
                </div>
            </div>
            <div class="w-1/2"><img src="https://www.realtyhive.com/images/homepage/NewHomepage/computer.png"></div>
        </x-frontend.home-section>

        <x-frontend.home-section>
            <div class="w-1/2"><img src="https://www.realtyhive.com/images/homepage/NewHomepage/Cashifyd.buy.png"></div>    
            <div class="leading-loose w-1/2">
                <h1 class="font-bold text-realty uppercase">We help you save money</h1>
                <h2 class="font-bold py-5 text-2xl">If you think your fees are too high</h2>
                <h3>Cashifyd connects you with agents across your market. You pick who you want to work with based on their offering and you get a cashback credit at closing - WIN WIN? We think so.</h3><br>
                <a href="#" class="font-bold text-realty">Learn more about Cashifyd<span class="arrowsmall"></span></a>
            </div>
        </x-frontend.home-section>
    </div>
    

    <div class="flex justify-center mt-10 mx-auto shadow-lg w-4/5">
        <div class="p-10 w-1/2">
            <h1 class="font-bold pb-4 text-4xl text-realty">Mid-Century Charmer</h1>
            <h2 class="font-bold pb-20 text-2xl">Sold in just 36 days!</h2>
            <a href="#" class="border border-blue-400 font-bold p-5 read-the-case rounded-full text-realty text-white">READ THE CASE STUDY</a>
        </div>
        <div class="w-1/2"><img src="https://www.realtyhive.com/images/homepage/NewHomepage/MidCenturyCharmer.png"></div>
    </div>

    <div class="bg-realty my-20 p-10">
        <div class="flex flex-col h-40 justi justify-between text-center">
                <h2 class="text-5xl text-white">Ready to see all the benefits?</h2>
                <a href="#" class="bg-white border font-bold mx-auto px-14 py-3 rounded-full">GET STARTED</a>
        </div>
    </div>
         
    <div>
        <div class="border-b-4 flex flex-col h-48 justify-between pb-20 text-center">
            <h2 class="font-bold text-3xl">Get the latest tips &amp; tricks to help you buy &amp; sell</h2>
            <form name="newsletter">
                <div class="flex items-center justify-center">
                    <input type="email" name="email" placeholder="Your email address" required=""
                            class="h-14 rounded-full shadow-2xl w-1/2">
                    <button type="submit" class="bg-realty border font-bold px-5 py-3 rounded-full text-2xl text-white">Subscribe</button>
                </div> 
            </form>
        </div>
    </div>

</x-app-layout>
