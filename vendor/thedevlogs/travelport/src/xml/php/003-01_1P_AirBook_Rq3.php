<?php
$air_res 			= $air_price_data['SOAP_Body']['air_AirPriceRsp'];
$air_segment 		= $air_res['air_AirItinerary']['air_AirSegment'];
$air_pricing_sol 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['@attributes'];
$air_pricing_info 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['@attributes'];
$air_fare_info 		= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_FareInfo'];
$air_booking_info 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_BookingInfo'];
$air_fare_calc 		= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_FareCalc'];
$air_passenger_type = $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_PassengerType'];
$air_baggage_info 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_BaggageAllowances']['air_BaggageAllowanceInfo'];
$air_carry_info 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_BaggageAllowances']['air_CarryOnAllowanceInfo'];
$air_tax_info 	= $air_res['air_AirPriceResult']['air_AirPricingSolution']['air_AirPricingInfo']['air_TaxInfo'];


$message='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">'.
'<soapenv:Header/>'.
'<soapenv:Body>'.
'<univ:AirCreateReservationReq xmlns:air="http://www.travelport.com/schema/air_v34_0" xmlns:common_v34_0="http://www.travelport.com/schema/common_v34_0" xmlns:univ="http://www.travelport.com/schema/universal_v34_0" AuthorizedBy="user" RetainReservation="Both" TargetBranch="'.$target_branch.'" TraceId="'.$trace_id.'">'.
'<com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v34_0" OriginApplication="UAPI"/>'.
'<com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v34_0" DOB="1971-12-24" Gender="M" Key="gr8AVWGCR064r57Jt0+8bA==" Nationality="CA" TravelerType="ADT">'.
'<com:BookingTravelerName First="Stephen" Last="Jones" Prefix="Mr"/>'.
'<com:DeliveryInfo>'.
	'<com:ShippingAddress>'.
		'<com:AddressName>Home</com:AddressName>'.
		'<com:Street>123 Dalton Drive</com:Street>'.
		'<com:City>Calgary</com:City>'.
		'<com:State>AB</com:State>'.
		'<com:PostalCode>T2P1K6</com:PostalCode>'.
		'<com:Country>CA</com:Country>'.
	'</com:ShippingAddress>'.
'</com:DeliveryInfo>'.
'<com:PhoneNumber AreaCode="403" CountryCode="1" Location="YYC" Number="555-1212"/>'.
'<com:Email EmailID="test@travelport.com" Type="Home"/>';

foreach($air_booking_info as $abik1 => $abiv1){
	if( !empty($air_booking_info[0]) ){
		foreach($abiv1 as $abik2 => $abiv2){
			if($abik2 == '@attributes'){
				$message .= '<com:SSR Carrier="DL" FreeText="P/IN/F1234567/IN/05Jan85/M/13Dec14/Jones/Stephen" SegmentRef="'.$abiv2['SegmentRef'].'" Status="HK" Type="DOCS" />';
			}
		}
	}else{
		if($abik1 == '@attributes'){
			$message .= '<com:SSR Carrier="DL" FreeText="P/IN/F1234567/IN/05Jan85/M/13Dec14/Jones/Stephen" SegmentRef="'.$abiv1['SegmentRef'].'" Status="HK" Type="DOCS" />';
		}
	}
}

$message .='<com:Address>'.
	'<com:AddressName>Home</com:AddressName>'.
	'<com:Street>123 Dalton Drive</com:Street>'.
	'<com:City>Calgary</com:City>'.
	'<com:State>AB</com:State>'.
	'<com:PostalCode>T2P1K6</com:PostalCode>'.
	'<com:Country>CA</com:Country>'.
'</com:Address>'.
'</com:BookingTraveler>'.
'<com:FormOfPayment xmlns:com="http://www.travelport.com/schema/common_v34_0" Key="jwt2mcK1Qp27I2xfpcCtAw==" Type="Cash"/>'.
'<air:AirPricingSolution ApproximateBasePrice="AUD474.00" ApproximateTaxes="AUD55.00" ApproximateTotalPrice="'.$air_pricing_sol['ApproximateTotalPrice'].'" BasePrice="'.$air_pricing_sol['BasePrice'].'" EquivalentBasePrice="'.$air_pricing_sol['EquivalentBasePrice'].'" Key="'.$air_pricing_sol['Key'].'" QuoteDate="2019-09-04" Taxes="'.$air_pricing_sol['Taxes'].'" TotalPrice="'.$air_pricing_sol['TotalPrice'].'">';

foreach($air_segment as $ask1 => $asv1){
	if( !empty($air_segment[0]) ){
		foreach($asv1 as $ask2 => $asv2){
			if($ask2 == '@attributes'){
				$message .='<air:AirSegment Key="'.$asv2['Key'].'" AvailabilityDisplayType="Fare Specific Fare Quote Unbooked" AvailabilitySource="S"  Distance="1207" Equipment="M90"   ClassOfService="H"  PolledAvailabilityOption="O and D cache or polled status used with different local status"  Group="'.$asv2['Group'].'" Carrier="'.$asv2['Carrier'].'" FlightNumber="'.$asv2['FlightNumber'].'" ProviderCode="'.$asv2['ProviderCode'].'" Origin="'.$asv2['Origin'].'" Destination="'.$asv2['Destination'].'" DepartureTime="'.$asv2['DepartureTime'].'" ArrivalTime="'.$asv2['ArrivalTime'].'" ChangeOfPlane="'.$asv2['ChangeOfPlane'].'" OptionalServicesIndicator="'.$asv2['OptionalServicesIndicator'].'" ParticipantLevel="'.$asv2['ParticipantLevel'].'" TravelTime="175">';
				$message .='<air:FlightDetails ArrivalTime="'.$asv2['ArrivalTime'].'" DepartureTime="'.$asv2['DepartureTime'].'" Destination="'.$asv2['Destination'].'" Distance="1207" FlightTime="175" Key="'.$asv2['Key'].'" Origin="'.$asv2['Origin'].'" TravelTime="175"/>	</air:AirSegment>';
			}
		}
	}else{
		if($ask1 == '@attributes'){
			$message .='<air:AirSegment Key="'.$asv1['Key'].'" AvailabilityDisplayType="Fare Specific Fare Quote Unbooked" AvailabilitySource="S"  Distance="1207" Equipment="M90"   ClassOfService="H"  PolledAvailabilityOption="O and D cache or polled status used with different local status"  Group="'.$asv1['Group'].'" Carrier="'.$asv1['Carrier'].'" FlightNumber="'.$asv1['FlightNumber'].'" ProviderCode="'.$asv1['ProviderCode'].'" Origin="'.$asv1['Origin'].'" Destination="'.$asv1['Destination'].'" DepartureTime="'.$asv1['DepartureTime'].'" ArrivalTime="'.$asv1['ArrivalTime'].'" ChangeOfPlane="'.$asv1['ChangeOfPlane'].'" OptionalServicesIndicator="'.$asv1['OptionalServicesIndicator'].'" ParticipantLevel="'.$asv1['ParticipantLevel'].'" TravelTime="175">';
			$message .='<air:FlightDetails ArrivalTime="'.$asv1['ArrivalTime'].'" DepartureTime="'.$asv1['DepartureTime'].'" Destination="'.$asv1['Destination'].'" Distance="1207" FlightTime="175" Key="'.$asv1['Key'].'" Origin="'.$asv1['Origin'].'" TravelTime="175"/>	</air:AirSegment>';
		}
	}
}

$message .='<air:AirPricingInfo ApproximateBasePrice="'.$air_pricing_info['ApproximateBasePrice'].'" ApproximateTaxes="'.$air_pricing_info['ApproximateTaxes'].'" ApproximateTotalPrice="'.$air_pricing_info['ApproximateTotalPrice'].'" BasePrice="'.$air_pricing_info['BasePrice'].'" ETicketability="Yes" EquivalentBasePrice="AUD474.00" IncludesVAT="false" Key="'.$air_pricing_info['Key'].'" LatestTicketingTime="'.$air_pricing_info['LatestTicketingTime'].'" PricingMethod="'.$air_pricing_info['PricingMethod'].'" ProviderCode="'.$air_pricing_info['ProviderCode'].'" Refundable="true" Taxes="AUD55.00" TotalPrice="'.$air_pricing_info['TotalPrice'].'">'.
'<air:FareInfo Amount="AUD474.00" DepartureDate="2019-11-25" Destination="ATL" EffectiveDate="2019-09-04T20:50:00.000+10:00" FareBasis="HA00A0RA" Key="uVJrqV4lQmOvkRtyhKU9/w==" Origin="DEN" PassengerTypeCode="ADT" TaxAmount="AUD55.00">'.
'<air:FareSurcharge Amount="USD9.30" Key="TMDlEQibTZKZfnpA40UOXw==" Type="Other"/>.
<air:FareRuleKey FareInfoRef="uVJrqV4lQmOvkRtyhKU9/w==" ProviderCode="1G">
6UUVoSldxwjWu4qeC9XeZcbKj3F8T9EyxsqPcXxP0TIjSPOlaHfQe5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA3ucz+gY8qdQO422wYI1U7fULUBEy9XlWF28KE5QrHqEQu0ZscBMSQ7AvMKi/VPtcv2N3B8I927SJwKiLuXXqI+0IABABb4EvGLgFn3B9sPd6v9tEaRJgF5C/YIEuJEelpGL74YNUBfVsbbOoAyZ1UFJTyB5x9tYSbUSm61kBU5OmjjOL2T2JlOymH/H9zMly0ACA4xcw3/+WZGGwTHecDWF/oTXxxF6MRdVAmZB4NevHZNO0IOqY3aUuA32Ku4i9aTq7yWBsNJLiYqD1taBKM9e1u/ZdGuhddeaQmysSzqhccvr40e6Z37hTdRV2s3CuDzD4Wdjal2fly5qxZ3qLwOXLmrFneovA5cuasWd6i8DUAh2WcSFc+w=
</air:FareRuleKey>
<air:Brand BrandID="5348" Carrier="DL" Key="1" Name="Economy" UpSellBrandID="5349">
<air:Title Type="External">Economy</air:Title>
<air:Title Type="Short">Economy</air:Title>
<air:Text Type="Upsell">
EASE INTO AN ECONOMY FARE Add more convenience Select your seat in advanceChange flights when plans change
</air:Text>
<air:Text Type="MarketingAgent">
EASE INTO AN ECONOMY FARE Add more convenience Select your seat in advanceChange flights when plans change
</air:Text>
<air:Text Type="Strapline">Low affordable fare with perks</air:Text>
<air:ImageLocation ImageHeight="150" ImageWidth="150" Type="Agent">
https://merchandisingmanagement.pp.travelport.com/documents/10431/12001/economy.png
</air:ImageLocation>
<air:OptionalServices>
<air:OptionalService Chargeable="Included in the brand" CreateDate="2019-09-04T10:50:23.481+00:00" Key="3P5fudNWRn2JzJbdSXdHLQ==" ServiceSubCode="OAE" Type="InFlightEntertainment">
<common_v34_0:ServiceData AirSegmentRef="Xpy1BrK1TGaQJg8tQ6PaWA=="/>
<common_v34_0:ServiceInfo>
<common_v34_0:Description/>
</common_v34_0:ServiceInfo>
<air:EMD AssociatedItem="Flight"/>
</air:OptionalService>
<air:OptionalService Chargeable="Included in the brand" CreateDate="2019-09-04T10:50:23.481+00:00" Key="kQhD6kRqRh+ZdhV3mDKh3Q==" SecondaryType="HS" ServiceSubCode="0AE" Type="InFlightEntertainment">
<common_v34_0:ServiceData AirSegmentRef="Xpy1BrK1TGaQJg8tQ6PaWA=="/>
<common_v34_0:ServiceInfo>
<common_v34_0:Description>HEADSET</common_v34_0:Description>
</common_v34_0:ServiceInfo>
<air:EMD AssociatedItem="Flight"/>
<air:Text Type="Strapline">HEADSET</air:Text>
</air:OptionalService>
</air:OptionalServices>
</air:Brand>
</air:FareInfo>
<air:BookingInfo BookingCode="H" CabinClass="Economy" FareInfoRef="uVJrqV4lQmOvkRtyhKU9/w==" SegmentRef="Xpy1BrK1TGaQJg8tQ6PaWA=="/>
<air:TaxInfo Amount="AUD7.70" Category="AY" Key="Htdq8DXLTeuKJS4VpWY2vg=="/>
<air:TaxInfo Amount="AUD35.60" Category="US" Key="7qmuHsp7SkqiWYNWEi0QBA=="/>
<air:TaxInfo Amount="AUD6.20" Category="XF" Key="oNkyptkQTaambVTqr2oeuA==">
<common_v34_0:TaxDetail Amount="USD4.50" OriginAirport="DEN"/>
</air:TaxInfo>
<air:TaxInfo Amount="AUD5.50" Category="ZP" Key="NsPGcqtzRduR6ec29cUqxw==">
<common_v34_0:TaxDetail Amount="USD4.00" OriginAirport="DEN"/>
</air:TaxInfo>
<air:FareCalc>DEN DL ATL Q9.30 335.81HA00A0RA USD345.11END</air:FareCalc>
<air:PassengerType Code="ADT"/>
<air:BaggageAllowances>
<air:BaggageAllowanceInfo Carrier="DL" Destination="ATL" Origin="DEN" TravelerType="ADT">
<air:URLInfo>
<air:URL>MYTRIPANDMORE.COM/BAGGAGEDETAILSDL.BAGG</air:URL>
</air:URLInfo>
<air:TextInfo>
<air:Text>0P</air:Text>
<air:Text>
BAGGAGE DISCOUNTS MAY APPLY BASED ON FREQUENT FLYER STATUS/ ONLINE CHECKIN/FORM OF PAYMENT/MILITARY/ETC.
</air:Text>
</air:TextInfo>
<air:BagDetails ApplicableBags="1stChecked" ApproximateBasePrice="AUD34.28" ApproximateTotalPrice="AUD34.28" BasePrice="USD25.00" TotalPrice="USD25.00">
<air:BaggageRestriction>
<air:TextInfo>
<air:Text>UPTO50LB/23KG AND UPTO62LI/158LCM</air:Text>
</air:TextInfo>
</air:BaggageRestriction>
</air:BagDetails>
<air:BagDetails ApplicableBags="2ndChecked" ApproximateBasePrice="AUD48.00" ApproximateTotalPrice="AUD48.00" BasePrice="USD35.00" TotalPrice="USD35.00">
<air:BaggageRestriction>
<air:TextInfo>
<air:Text>UPTO50LB/23KG AND UPTO62LI/158LCM</air:Text>
</air:TextInfo>
</air:BaggageRestriction>
</air:BagDetails>
</air:BaggageAllowanceInfo>
<air:CarryOnAllowanceInfo Carrier="DL" Destination="ATL" Origin="DEN">
<air:TextInfo>
<air:Text>1P</air:Text>
</air:TextInfo>
<air:CarryOnDetails ApplicableCarryOnBags="1" ApproximateBasePrice="AUD0.00" ApproximateTotalPrice="AUD0.00" BasePrice="USD0.00" TotalPrice="USD0.00">
<air:BaggageRestriction>
<air:TextInfo>
<air:Text>PERSONAL ITEM</air:Text>
</air:TextInfo>
</air:BaggageRestriction>
</air:CarryOnDetails>
</air:CarryOnAllowanceInfo>
<air:EmbargoInfo Carrier="DL" Destination="ATL" Origin="DEN">
<air:URLInfo>
<air:URL>MYTRIPANDMORE.COM/BAGGAGEDETAILSDL.BAGG</air:URL>
</air:URLInfo>
<air:TextInfo>
<air:Text>888</air:Text>
</air:TextInfo>
</air:EmbargoInfo>
</air:BaggageAllowances>
</air:AirPricingInfo>
</air:AirPricingSolution>
<com:ActionStatus xmlns:com="http://www.travelport.com/schema/common_v34_0" ProviderCode="1G" TicketDate="2019-09-05T17:14:23" Type="TAW"/>
</univ:AirCreateReservationReq>
</soapenv:Body>
</soapenv:Envelope>';