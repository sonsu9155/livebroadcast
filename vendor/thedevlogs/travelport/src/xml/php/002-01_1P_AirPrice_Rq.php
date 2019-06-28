<?php

		
$message =  '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">   
				<soapenv:Header/>   
				<soapenv:Body>      
					<air:AirPriceReq xmlns:air="http://www.travelport.com/schema/air_v29_0" AuthorizedBy="user" TargetBranch="'.$target_branch.'" TraceId="'.$trace_id.'">        <com:BillingPointOfSaleInfo xmlns:com="http://www.travelport.com/schema/common_v29_0" OriginApplication="UAPI"/>         
						<air:AirItinerary>';  
						foreach($segment_data as $segment){          
							$message .= '<air:AirSegment ArrivalTime="'.$segment['ArrivalTime'].'" AvailabilityDisplayType="Fare Shop/Optimal Shop" AvailabilitySource="'.$segment['AvailabilitySource'].'" Carrier="'.$segment['Carrier'].'" ChangeOfPlane="'.$segment['ChangeOfPlane'].'" ClassOfService="L" DepartureTime="'.$segment['DepartureTime'].'" Destination="'.$segment['Destination'].'" Distance="'.$segment['Distance'].'" ETicketability="'.$segment['ETicketability'].'" Equipment="'.$segment['Equipment'].'" FlightNumber="'.$segment['FlightNumber'].'" FlightTime="'.$segment['FlightTime'].'" Group="'.$segment['Group'].'" Key="'.$segment['Key'].'" LinkAvailability="true" OptionalServicesIndicator="'.$segment['OptionalServicesIndicator'].'" Origin="'.$segment['Origin'].'" ParticipantLevel="'.$segment['ParticipantLevel'].'" PolledAvailabilityOption="Polled avail used" ProviderCode="'.$provider.'"/>';    
						}     
						$message .= '</air:AirItinerary>         
						<air:AirPricingModifiers PlatingCarrier="QF"/>         
						<com:SearchPassenger xmlns:com="http://www.travelport.com/schema/common_v29_0" BookingTravelerRef="'.uniqid().'" Code="ADT"/>         
						<air:AirPricingCommand/>      
					</air:AirPriceReq>   
				</soapenv:Body>
			</soapenv:Envelope>';
	//pr($message);die;
