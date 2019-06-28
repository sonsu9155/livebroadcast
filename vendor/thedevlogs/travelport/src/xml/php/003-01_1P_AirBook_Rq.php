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

$message='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
    <soapenv:Header />
    <soapenv:Body>
        <univ:AirCreateReservationReq xmlns:univ="http://www.travelport.com/schema/universal_v29_0" AuthorizedBy="'.$user.'" RetainReservation="Both" TargetBranch="'.$target_branch.'" TraceId="'.$trace_id.'">
            <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v29_0" OriginApplication="UAPI" />
            <com:BookingTraveler xmlns:com="http://www.travelport.com/schema/common_v29_0" DOB="1985-01-05" Gender="M" Key="UX6FWr4R2BKADt1\/BAAAAA==" TravelerType="ADT">
                <com:BookingTravelerName First="Stephen" Last="Jones" Prefix="Mr" />
                <com:DeliveryInfo>
                    <com:ShippingAddress>
                        <com:AddressName>Home</com:AddressName>
                        <com:Street>123 Dalton Drive</com:Street>
                        <com:City>Calgary</com:City>
                        <com:State>AB</com:State>
                        <com:PostalCode>T2P1K6</com:PostalCode>
                        <com:Country>CA</com:Country>
                    </com:ShippingAddress>
                </com:DeliveryInfo>
                <com:PhoneNumber AreaCode="403" CountryCode="1" Location="YYC" Number="555-1212" />
                <com:Email EmailID="test@travelport.com" Type="Home" />';
				
				// foreach($air_booking_info as $abik1 => $abiv1){
				// 	if( !empty($air_booking_info[0]) ){
				// 		foreach($abiv1 as $abik2 => $abiv2){
				// 			if($abik2 == '@attributes'){
								$message .= '<com:SSR Carrier="DL" FreeText="P/IN/F1234567/IN/05Jan85/M/13Dec14/Jones/Stephen" SegmentRef="'.$air_booking_info['@attributes']['SegmentRef'].'" Status="HK" Type="DOCS" />';
				// 			}
				// 		}
				// 	}else{
				// 		if($abik1 == '@attributes'){
				// 			$message .= '<com:SSR Carrier="DL" FreeText="P/IN/F1234567/IN/05Jan85/M/13Dec14/Jones/Stephen" SegmentRef="'.$abiv1['SegmentRef'].'" Status="HK" Type="DOCS" />';
				// 		}
				// 	}
				// }
				
               $message .= '<com:Address>
                    <com:AddressName>Home</com:AddressName>
                    <com:Street>123 Dalton Drive</com:Street>
                    <com:City>Calgary</com:City>
                    <com:State>AB</com:State>
                    <com:PostalCode>T2P1K6</com:PostalCode>
                    <com:Country>CA</com:Country>
                </com:Address>
            </com:BookingTraveler>
            <com:AgencyContactInfo xmlns:com="http://www.travelport.com/schema/common_v29_0">
                <com:PhoneNumber Number="0506998223" AreaCode="07" Text="Elnatan" Type="Agency" CountryCode="050" />
            </com:AgencyContactInfo>
			
			
            <air:AirPricingSolution xmlns:air="http://www.travelport.com/schema/air_v29_0" Key="'.$air_pricing_sol['Key'].'" TotalPrice="'.$air_pricing_sol['TotalPrice'].'" BasePrice="'.$air_pricing_sol['BasePrice'].'" ApproximateTotalPrice="'.$air_pricing_sol['ApproximateTotalPrice'].'" ApproximateBasePrice="'.$air_pricing_sol['ApproximateBasePrice'].'" EquivalentBasePrice="'.$air_pricing_sol['EquivalentBasePrice'].'" Taxes="'.$air_pricing_sol['Taxes'].'" ApproximateTaxes="'.$air_pricing_sol['ApproximateTaxes'].'">';
		
				// foreach($air_segment as $ask1 => $asv1){
				// 	if( !empty($air_segment[0]) ){
				// 		foreach($asv1 as $ask2 => $asv2){
				// 			if($ask2 == '@attributes'){
								$message .='<air:AirSegment Key="'.$air_segment['@attributes']['Key'].'" Group="'.$air_segment['@attributes']['Group'].'" Carrier="'.$air_segment['@attributes']['Carrier'].'" FlightNumber="'.$air_segment['@attributes']['FlightNumber'].'" ProviderCode="'.$air_segment['@attributes']['ProviderCode'].'" Origin="'.$air_segment['@attributes']['Origin'].'" Destination="'.$air_segment['@attributes']['Destination'].'" DepartureTime="'.$air_segment['@attributes']['DepartureTime'].'" ArrivalTime="'.$air_segment['@attributes']['ArrivalTime'].'" OptionalServicesIndicator="'.$air_segment['@attributes']['OptionalServicesIndicator'].'" ParticipantLevel="'.$air_segment['@attributes']['ParticipantLevel'].'" />';
				// 			}
				// 		}
				// 	}else{
				// 		if($ask1 == '@attributes'){
				// 			$message .='<air:AirSegment Key="'.$air_pricing_sol['Key'].'" Group="'.$asv1['Group'].'" Carrier="'.$asv1['Carrier'].'" FlightNumber="'.$asv1['FlightNumber'].'" ProviderCode="'.$asv1['ProviderCode'].'" Origin="'.$asv1['Origin'].'" Destination="'.$asv1['Destination'].'" DepartureTime="'.$asv1['DepartureTime'].'" ArrivalTime="'.$asv1['ArrivalTime'].'" ChangeOfPlane="'.$asv1['ChangeOfPlane'].'" OptionalServicesIndicator="'.$asv1['OptionalServicesIndicator'].'" ParticipantLevel="'.$asv1['ParticipantLevel'].'" />';
				// 		}
				// 	}
				// }
				
	
               $message .='<air:AirPricingInfo Key="'.$air_pricing_info['Key'].'" TotalPrice="'.$air_pricing_info['TotalPrice'].'" BasePrice="'.$air_pricing_info['BasePrice'].'" ApproximateTotalPrice="'.$air_pricing_info['ApproximateTotalPrice'].'" ApproximateBasePrice="'.$air_pricing_info['ApproximateBasePrice'].'" ApproximateTaxes="'.$air_pricing_info['ApproximateTaxes'].'" Taxes="'.$air_pricing_info['Taxes'].'" LatestTicketingTime="'.$air_pricing_info['LatestTicketingTime'].'" PricingMethod="'.$air_pricing_info['PricingMethod'].'"  ProviderCode="'.$air_pricing_info['ProviderCode'].'">';
			   
			  // var_dump($air_fare_info);exit();
			   
                   //foreach($air_fare_info as $afik1 => $afiv1){
							//foreach($afiv1 as $afik2 => $afiv2){
							//var_dump($afik1);exit();
								//if($afik1 == '@attributes'){
						$message .=' <air:FareInfo Key="'.$air_fare_info['@attributes']['Key'].'" FareBasis="'.$air_fare_info['@attributes']['FareBasis'].'" PassengerTypeCode="'.$air_fare_info['@attributes']['PassengerTypeCode'].'" Origin="'.$air_fare_info['@attributes']['Origin'].'" Destination="'.$air_fare_info['@attributes']['Destination'].'" EffectiveDate="'.$air_fare_info['@attributes']['EffectiveDate'].'" Amount="'.$air_fare_info['@attributes']['Amount'].'"><air:FareRuleKey FareInfoRef="'.$air_fare_info['@attributes']['Key'].'" ProviderCode="1G">'.$air_fare_info['air_FareRuleKey'].'</air:FareRuleKey></air:FareInfo>';
					//}
							//}
						// }else{
						// 	if($afiv1 == '@attributes'){
						// 		$message .=' <air:FareInfo Key="'.$air_pricing_sol['Key'].'" FareBasis="'.$afiv1['@attributes']['FareBasis'].'" PassengerTypeCode="'.$afiv1['@attributes']['PassengerTypeCode'].'" Origin="'.$afiv1['@attributes']['Origin'].'" Destination="'.$afiv1['@attributes']['Destination'].'" EffectiveDate="'.$afiv1['@attributes']['EffectiveDate'].'" Amount="'.$afiv1['@attributes']['Amount'].'"><air:FareRuleKey FareInfoRef="'.$afiv1['@attributes']['Key'].'" ProviderCode="1G">'.$afiv1['airFareRuleKey'].'</air:FareRuleKey>
						// 		</air:FareInfo>';
						// 	}
						// }
					//}
						
					// foreach($air_booking_info as $abik1 => $abiv1){
					// 	if( !empty($air_booking_info[0]) ){
					// 		foreach($abiv1 as $abik2 => $abiv2){
					// 			if($abik2 == '@attributes'){
									$message .='<air:BookingInfo BookingCode="'.$air_booking_info['@attributes']['BookingCode'].'" CabinClass="'.$air_booking_info['@attributes']['CabinClass'].'" FareInfoRef="'.$air_booking_info['@attributes']['FareInfoRef'].'" SegmentRef="'.$air_booking_info['@attributes']['SegmentRef'].'" />';
					// 			}
					// 		}
					// 	}else{
					// 		if($abik1 == '@attributes'){
					// 			$message .='<air:BookingInfo BookingCode="'.$abiv1['BookingCode'].'" CabinClass="'.$abiv1['CabinClass'].'" FareInfoRef="'.$abiv1['FareInfoRef'].'" SegmentRef="'.$abiv1['SegmentRef'].'" />';
					// 		}
					// 	}
					// }
				
				
					foreach($air_tax_info as $ati => $ativ){
						$message .= '<air:TaxInfo Category="'.$ativ['@attributes']['Category'].'" Amount="'.$ativ['@attributes']['Amount'].'" Key="'.$ativ['@attributes']['Key'].'" />';
					}
					
                    $message .='<air:FareCalc>'.$air_fare_calc.'</air:FareCalc>
					
                    <air:PassengerType Code="'.$air_passenger_type['@attributes']['Code'].'" />
					
                    <air:BaggageAllowances> 
                        <air:BaggageAllowanceInfo TravelerType="'.$air_baggage_info['@attributes']['TravelerType'].'" Origin="'.$air_baggage_info['@attributes']['Origin'].'" Destination="'.$air_baggage_info['@attributes']['Destination'].'" Carrier="'.$air_baggage_info['@attributes']['Carrier'].'">
                            <air:URLInfo>
                                <air:URL>'.$air_baggage_info['air_URLInfo']['air_URL'].'</air:URL>
                            </air:URLInfo>';
							
                            $message .='<air:TextInfo>';
							foreach($air_baggage_info['air_TextInfo']['air_Text'] as $air_Text){
                                $message .='<air:Text>'.$air_Text.'</air:Text>';
							}
                            $message .='</air:TextInfo>';
							
							foreach($air_baggage_info['air_BagDetails'] as $bagdetails){
								$message .='<air:BagDetails ApplicableBags="'.$bagdetails['@attributes']['ApplicableBags'].'" BasePrice="'.$bagdetails['@attributes']['BasePrice'].'" ApproximateBasePrice="'.$bagdetails['@attributes']['ApproximateBasePrice'].'" 	TotalPrice="'.$bagdetails['@attributes']['TotalPrice'].'" ApproximateTotalPrice="'.$bagdetails['@attributes']['ApproximateTotalPrice'].'">
                                <air:BaggageRestriction>
                                    <air:TextInfo>
                                        <air:Text>'.$bagdetails['air_BaggageRestriction']['air_TextInfo']['air_Text'].'</air:Text>
                                    </air:TextInfo>
                                </air:BaggageRestriction>
								</air:BagDetails>';
							}
							
                         $message .='</air:BaggageAllowanceInfo>
						
						<air:CarryOnAllowanceInfo Origin="'.$air_carry_info['@attributes']['Origin'].'" Destination="'.$air_carry_info['@attributes']['Destination'].'" Carrier="'.$air_carry_info['@attributes']['Carrier'].'">
                            <air:URLInfo />';
							foreach($air_carry_info['air_TextInfo'] as $air_carry_textinfo){
								$message .=' <air:TextInfo>
									<air:Text>'.$air_carry_textinfo['air_Text'].'</air:Text>
								</air:TextInfo>';
							}
							
							foreach($air_carry_info['air_CarryOnDetails'] as $k => $v){
								if( !empty($air_carry_info['air_CarryOnDetails'][0]) ){
									foreach($v as $k1 => $v1){
										if($k1 == '@attributes'){
											$message .='<air:CarryOnDetails ApplicableCarryOnBags="'.$v1['ApplicableCarryOnBags'].'" BasePrice="'.$v1['BasePrice'].'" ApproximateBasePrice="'.$v1['ApproximateBasePrice'].'" TotalPrice="'.$v1['TotalPrice'].'" ApproximateTotalPrice="'.$v1['ApproximateTotalPrice'].'" />';
										}
									}
								}else{
									if($k == '@attributes'){
										$message .='<air:CarryOnDetails ApplicableCarryOnBags="'.$v['ApplicableCarryOnBags'].'" BasePrice="'.$v['BasePrice'].'" ApproximateBasePrice="'.$v['ApproximateBasePrice'].'" TotalPrice="'.$v['TotalPrice'].'" ApproximateTotalPrice="'.$v['ApproximateTotalPrice'].'" />';
									}
								}
							}

                            
							
                        $message .='</air:CarryOnAllowanceInfo>';
						
                    $message .='</air:BaggageAllowances>
                </air:AirPricingInfo>
            </air:AirPricingSolution>';
			
			$current_date = date('Y-m-d\TH:i:s', strtotime("now +60 minutes") );
            $message .='<com:ActionStatus xmlns:com="http://www.travelport.com/schema/common_v29_0" ProviderCode="1G" TicketDate="2019-12-20T10:35:52" Type="TAW" />';
			
        $message .='</univ:AirCreateReservationReq>
    </soapenv:Body>
</soapenv:Envelope>';