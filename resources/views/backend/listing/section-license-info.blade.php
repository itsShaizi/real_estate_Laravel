<x-backend.section title="Licensing Info">
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <x-label>Auctioneer</x-label>
            <x-input name="auctioneer"/>
        </div>
        <div>
            <x-label>Auctioneer License</x-label>
            <x-input disabled name="auctioneer_license"/>
        </div>
        <div>
            <x-label>Real Estate Agent License</x-label>
            <x-input disabled name="real_estate_agent_license"/>
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 mt-4">
        <div>
            <x-label>Auctioneer Firm</x-label>
            <x-input name="auctioneer_firm"/>
        </div>
        <div>
            <x-label>Auctioneer Firm License</x-label>
            <x-input disabled name="auctioneer_firm_license"/>
        </div>
        <div>
            <x-label>Brokerage Firm</x-label>
            <x-input name="brokerage_firm"/>
        </div>
        <div>
            <x-label>Brokerage License</x-label>
            <x-input disabled name="brokerage_license"/>
        </div>
        <div>
            <x-label>Broker</x-label>
            <x-input name="broker"/>
        </div>
        <div>
            <x-label>Broker License</x-label>
            <x-input disabled name="broker_license"/>
        </div>
    </div>
</x-backend.section>