<x-landing-layout>
    
<div class="bg-center bg-rh-image-duediligence -mt-32">
    <div class="h-full bg-blue-500 bg-opacity-75">
        <div class="md:w-3/5 pt-5 pb-5 text-center mx-auto pt-40">
            <h1 class="text-white text-7xl pb-2 mb-12">Learn More<span style="color:#FFD226">.</span></h1>        
        </div>
    </div>
</div>

<div class="container max-w-7xl mx-auto">

    <x-frontend.learn-more.learn-more-menu>
    </x-frontend.learn-more.learn-more-menu>

    <div class="container md:mx-6 mb-8">
        <h2 class="font-bold text-3xl text-center md:text-left md:text-5xl text-blue-400 mb-8 uppercase">AUCTION PROCESS</h2>
        <div class="md:flex mx-auto">

            <div x-data="{ currentTab : 'How it works'}">
                <div class="container md:flex mx-auto">
                    <button @click="currentTab = 'How it works'" class="flex rounded-full text-center font-bold border-2 border-gray-300 md:m-6 p-2 md:w-2/5 hover:text-blue-400 mx-auto">How it works</button>
                        <span class="flex justify-center text-lg text-blue-400 md:ml-3 mx-auto md:transform md:-rotate-90">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </span>
                    <button @click="currentTab = 'Pre-auction offer'" class="flex rounded-full text-center font-bold border-2 border-gray-300 md:w-2/5 md:-ml-4 md:m-6 p-2 hover:text-blue-400 mx-auto">Pre-auction offer</button>                     
                        <span class="flex justify-center text-lg text-blue-400 lg:ml-3 md:transform md:-rotate-90">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </span>
                    <button @click="currentTab = 'Place a bid'" class="flex rounded-full text-center font-bold border-2 border-gray-300 md:w-2/5 md:-ml-4 md:m-6 p-2 hover:text-blue-400 mx-auto">Place a bid</button>
                        <span class="flex justify-center text-lg text-blue-400 md:ml-3 md:transform md:-rotate-90">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </span>
                    <button @click="currentTab = 'Change my bid'" class="flex rounded-full text-center font-bold border-2 border-gray-300 md:w-2/5 md:-ml-4 md:m-6 p-2 hover:text-blue-400 mx-auto">Change my bid</button>                     
                        <span class="flex justify-center text-lg text-blue-400 md:ml-3 md:transform md:-rotate-90">
                            <i class="fas fa-caret-down fa-3x"></i>
                        </span>
                    <button @click="currentTab = 'Back-up bid'" class="flex rounded-full text-center font-bold border-2 border-gray-300 md:w-2/5 md:-ml-4 md:m-6 p-2 inline-block hover:text-blue-400 active:text-blue-400 mx-auto">Back-up bid</button>
                </div>
                
                <div x-show="currentTab === 'How it works'">         
                    <div class="container max-w-7xl mt-16 md:m-8 text-center md:text-left">
                        <div class="md:flex border-b-2 my-8">
                            <img class="object-top md:object-left my-auto mx-auto m-8" src="/img/learn-more/auction-step-1.png" />
                            <p class="m-8" ><b>Register for a RealtyHive.com account.</b> By registering to bid, the buyer acknowledges that they have downloaded, read, reviewed and understand the information in the terms and conditions and consent to entering into electronic transactions over the internet. When you make a bid, you are acknowledging that you have read, reviewed and understand all of the information contained in the bid packet for that particular property. The bidder also acknowledges that immediately following the close of auction, they are prepared to execute the Contract of Sale agreement and pay the appropriate deposit at that time in a form that has previously been deemed acceptable to the Auction Company.</p> 
                        </div>
                        <div class="md:flex border-b-2 my-8">
                            <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/auction-step-2.png" />
                            <p class="m-8" ><b>Determine how much you are willing to pay for a property.</b> Since your needs and desires are unique, your evaluation of the property will be different from anyone else's as well as the amount you are willing to pay.</p>
                        </div>
                        <div class="md:flex border-b-2 my-8">
                            <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/auction-step-3.png" />
                            <p class="m-8">As the auction progresses, when you want to make a bid, you <b>enter the amount you wish to bid in the appropriate box and click the BID NOW button</b>. You will not be allowed to bid against yourself. The online auction will be conducted under the total control of the auctioneer.</p> 
                        </div>
                        <div class="md:flex border-b-2 my-8">
                            <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/auction-step-4.png" />
                            <p class="m-8" ><b>If you have any questions or need any assistance, you can click the "ask a question"</b> and email your question to one of the RealtyHive Team members. These individuals are there to help you understand the process completely.</p>
                        </div>
                        <div class="md:flex my-8">
                            <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/auction-step-5.png" />
                            <p class="m-8">The most important thing to do at auction is relax and have fun. If you have question, ask it. We strive to ensure that all of our customers are fully informed and educated. And remember<br/><br/> <span class="text-blue-rh"> You're only going to pay one bid more than someone was willing to pay.</span></p>
                        </div>
                    </div>
                    <h3 class="font-bold text-3xl text-blue-400 mx-auto mb-2 md:mt-16 text-center md:text-left">Typical Additional Questions</h3>
                    <div class="md:my-4 text-center md:text-left px-4 md:px-0">
                        <p class="mt-8 mb-4">
                            <b>Do I need to Pre-Qualify? </b>
                            No. We normally do not require pre-qualification to bid; however, if you intend to obtain bank financing, the bank will require you to qualify for their loan.
                        </p>
                        <p class="mb-4">
                            The deposit you make on the day that the bid is entered is not contingent upon financing and, if you are the successful bidder, the deposit will not be refunded if you fail to subsequently execute the Contract of Sale and close. The Contract for Sale is included in full in the bid packet, is a form which is required by the Seller and the terms and conditions of which may not be altered or modified, in any way. 
                        </p>
                        <p class="mb-4">
                            <b>What is a Buyer's Fee?</b></br> 
                            A buyer's fee is a percentage that is added to the bid price to determine the total purchase price. In our auctions, there will be a buyer's fee added to the successful bid amount to create the total purchase price; the amount of the buyer's fee amounts can be found in the bidder's packets, as they vary from property to property. The earnest money (the amount in addition to the amount which was made by credit card deposit when you entered you bid) will be non-refundable (except otherwise specifically provided in the Sellers' Contact of Sale) and due within 24 hours of date and time on which you are sent an email informing you that you are the successful bidder. The balance of the contract purchase price shall be due at closing. 
                        </p>
                        <p>
                            <b>What if I'm a Broker?</b><br/> We offer a Broker Participation Fee to any licensed Real Estate Broker who properly registers a client. Registration forms must be completed at least 48 hours prior to the first bid being made by the client of the Broker. Call 888-926-5724 to request a Broker Participation Form. 
                        </p>
                    </div>
                </div>

                <div x-show="currentTab === 'Pre-auction offer'">           
                    <div class="container md:flex max-w-7xl md:m-8">
                        <div class="md:w-2/5 mx-auto">
                             <img src="/img/learn-more/pre-auction-sample.png" alt="Pre-auction Sample" />
                        </div> 
                        <div class="md:w-3/5 m-8 text-center md:text-left">
                            <p class="lg:mt-16 md:mt-4 mb-4" >An auction property can be purchased prior to the start of the auction by placing a Pre-Auction Offer to purchase the property. This follows the normal purchase processes of a traditional property sale.</p>
                            <p class="mb-4" >You must be logged in to your user account to place a pre-auction property offer, and your user account must be enabled as a buyer/bidder or broker/agent. </p>
                            <p>If the offer to purchase is accepted by the seller or broker/agent, the property listing will be removed from the upcoming auction event.</p>
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'Place a bid'">         
                    <div class="container md:flex mt-8">
                        <div class="md:w-2/5 md:mt-8">
                            <img src="/img/learn-more/place-a-bid-sample.png" alt="Place A Bid Sample" />
                        </div> 
                        <div class="md:w-3/5 mx-8 text-center md:text-left">
                            <p class="mt-12 mb-4" >Once an auction event has started, you will be able to place a bid on a property at any time up until the auction event closes. A red end auction count-down timer is displayed on the View Details page of an auction sale property that is involved in an active auction event.</p>
                            <p class="mb-4" >When you place a bid, you acknowledge that you have read, reviewed and understand all of the information contained in the bid packet for the particular property you are bidding on. You also acknowledge that immediately following the close of auction, you are prepared to execute the Contract of Sale agreement and pay the appropriate deposit amount in a method deemed acceptable to the Auction Company listed for the property.</p>
                            <p class="mb-4" >You must be logged in to your user account in order to place a bid on an auction property, and your user account must be enabled as a buyer/bidder or broker/agent.</p>
                            <p class="mb-4">To place a bid, enter your bid amount in the My Max Bid field and click on the Bid Now button to submit your property bid.</p>
                            <p class="mb-4">You will receive an email after the auction ends if you were the highest bidder on the property.</p>
                            <p class="mb-4 font-bold">Buyer/Bidders wishing to place bids in an upcoming auction must be registered as a user at least forty-eight (48) hours prior to the start of the auction.</p>
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'Change my bid'">           
                    <div class="container md:flex mt-8">
                         <div class="md:w-2/5">
                             <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/change-my-bid-sample.png" alt="Change My Bid Sample" />
                        </div> 
                        <div class="md:w-3/5 m-8 text-center md:text-left">
                            <p class="mt-12 mb-4"><b>You are not permitted to bid against yourself</b>, so you are not able to increase your bid amount if you are currently the highest bidder on an auction property. However, if you made an error entering and submitting your bid amount, please contact a realtyhive representative as soon as possible to get your bid amount corrected.</p>
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'Back-up bid'">         
                    <div class="container md:flex mt-8">
                        <div class="md:w-2/5">
                            <img class="object-top md:object-left mx-auto m-8" src="/img/learn-more/back-up-bid-sample.png" alt="Back-up Bid Sample" />
                        </div> 
                        <div class="md:w-3/5 m-8 text-center md:text-left">
                            <p class="mt-12 mb-4">After an auction event has ended, you can submit a back-up bid on an auction property in case the property sale to the highest bidder is not successfull.</p>
                            <p class="mb-4">Back-Up Bids will be accepted up to 48 hours after the auction has closed. </p>
                            <p>You must be logged in to your user account to place a back-up bid on an auction property, and your user account must be enabled as a buyer/bidder or broker/agent.</p>
                        </div>
                    </div>
                </div> <!-- end of current tabs -->
            </div> <!-- end of x-data -->
        </div>
    </div> <!-- end of container -->
</div> <!-- end of container -->

</x-landing-layout>