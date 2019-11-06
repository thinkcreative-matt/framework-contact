<div class="contact-container container">
	<div class="post card" itemscope itemtype="http://schema.org/Organization">
		<h2 class="post-title card-title">Contact Details</h2>
		<div class="post-body card-body">
			<h3><span itemprop="name">{{$contact->companyname}}</span></h3>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<h4 class="description">Main address:</h4>
				<hr>
				<span itemprop="streetAddress" class="street-name">{{$contact->address->streetname}}</span>
				@empty($contact->address->optionalstreet)
				@else
					<span class="street-name">{{$contact->address->optionalstreet}}</span>
				@endif
				<span itemprop="addressLocality" class="localilty">{{$contact->address->locality}}</span>
				<span itemprop="postalCode" class="post-code">{{$contact->address->postcode}}</span>
			</div>

			<ul>
				<li>Tel:<span itemprop="telephone">{{$contact->number}}</span></li>
				<li>E-mail: <span itemprop="email">{{$contact->email}}</span></li>
			</ul>
		</div>
	</div>
</div>
