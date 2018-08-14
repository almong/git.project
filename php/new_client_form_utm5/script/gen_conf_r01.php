<?php
	$ls = $_POST['ls'];
	$network = $_POST['network'];
	$vlan = $_POST['vlan'];
		
	$ip_long = ip2long($network);
	$ip_gw = $ip_long + 1;
	$ip_client = $ip_long + 2;
	$ip_gw = long2ip($ip_gw);
	$ip_client = long2ip($ip_client);
?>	
<p class="conf_gen"><?php echo "interface vlan add name=vlan$vlan vlan-id=$vlan interface=ether2_downlink";?></p>
<p class="conf_gen"><?php echo "ip address add address=$ip_gw/30 interface=vlan$vlan";?></p>
<p class="conf_gen"><?php echo "ip pool add name=vlan$vlan ranges=$ip_client";?></p>
<p class="conf_gen"><?php echo "ip dhcp-server network add address=$network/30 gateway=$ip_gw";?></p>
<p class="conf_gen"><?php echo "ip dhcp-server add name=vlan$vlan interface=vlan$vlan address-pool=vlan$vlan lease-time=00:05:00 disabled=no";?></p>
<p class="conf_gen"><?php echo "ip firewall address-list add list=block_ip address=$network/30 comment=$ls";?></p>
<p class="conf_gen"><?php echo "ip firewall address-list add list=activation address=$network/30";?></p>







