<?php

    $port = $_POST['port'];
    $tu = $_POST['tu'];
    if(isset($_POST['ip']))
    {
        $ip = $_POST['ip'];
    }
    // Ҫ��sudo����ȻûȨ��
    if($_POST['status']=='temporaryAdd')
    {
        $port = explode(',',$port);
        foreach($port as $pp)
        {
            $result = `sudo firewall-cmd --add-port=$pp/$tu`;
        }
    }
    else if($_POST['status']==='temporaryDel')
    {
        $port = explode(',',$port);
        foreach($port as $pp)
        {
            $result = `sudo firewall-cmd --remove-port=$pp/$tu`;
        }
        //$result = `sudo firewall-cmd --remove-port=$port/$tu`;
    }
    else if($_POST['status']==='permanentAdd')
    {
        $port = explode(',',$port);
        foreach($port as $pp)
        {
            $doc = new DOMDocument('1.0','utf8');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;
            $doc->load("/etc/firewalld/zones/public.xml");
            $xpath = new DOMXPath($doc);
            $exp = "//port[@protocol='$tu' and @port='$pp']";
            if($xpath->query($exp)->length>0)   //����Ѿ�����������
            {
                continue;
            }
            $portNode = $doc->createElement('port');
            $portNode->setAttribute('protocol',$tu);
            $portNode->setAttribute('port',$pp);
            $parent = $doc->getElementsByTagName('zone')->item(0);
            $parent->appendChild($portNode);

            $doc->save("/etc/firewalld/zones/public.xml");  //ע�⣬���湤������д��ѭ�����棬��Ȼֻ�ᱣ�����һ��
            
        }
        $result = `sudo firewall-cmd --reload`;
    }
    else if($_POST['status']==='permanentDel')
    {
        $port = explode(',',$port);
        foreach($port as $pp)
        {
            $doc = new DOMDocument('1.0','utf8');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;
            $doc->load("/etc/firewalld/zones/public.xml");
            
            $xpath = new DOMXPath($doc);
            $exp = "//port[@protocol='$tu' and @port='$pp']";
            $nodes = $xpath->query($exp);
            if($nodes->length==0)
            {
                continue;
            }
            $nodes->item(0)->parentNode->removeChild($nodes->item(0));
            $doc->save("/etc/firewalld/zones/public.xml");
            
        }
        $result = `sudo firewall-cmd --reload`;
    }
    else if($_POST['status']==='temporaryAdd_ip')
    {
        if(!isset($ip))
        {
            die("δ�ҵ�ip��ַ,����");
        }
        $ports = explode(",",$port);
        foreach($ports as $pp)
        {
            $result = `sudo firewall-cmd --add-rich-rule='rule family=ipv4 source address=$ip port protocol=$tu port=$pp accept'`;
        }
        // echo $result;
    }
    else if($_POST['status']==='temporaryDel_ip')
    {
        if(!isset($ip))
        {
            die("δ�ҵ�ip��ַ,����");
        }
        $ports = explode(",",$port);
        foreach($ports as $pp)
        {
            $result = `sudo firewall-cmd --remove-rich-rule='rule family=ipv4 source address=$ip port protocol=$tu port=$pp accept'`;
        }
    }
    else if($_POST['status']==='permanentAdd_ip')
    {
        if(!isset($ip))
        {
            die("δ�ҵ�ip��ַ,����");
        }
        $ports = explode(",",$port);
        foreach($ports as $pp)
        {
            $flag = 0;
            $doc = new DOMDocument('1.0','utf8');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;
            $doc->load("/etc/firewalld/zones/public.xml");
            $xpath = new DOMXPath($doc);
            
            $exp = "//rule[@family='ipv4']";
            $nodes = $xpath->query($exp);
            foreach($nodes as $node)
            {
                if($node->childNodes->item(0)->attributes->item(0)->nodeValue==$ip &&
                $node->childNodes->item(1)->attributes->item(0)->nodeValue==$tu && 
                $node->childNodes->item(1)->attributes->item(1)->nodeValue==$pp)
                {
                    $flag = 1;
                    break;
                }
            }
            if($flag==1)
            {
                continue;
            }

            $node = $doc->createElement("rule");
            $node->setAttribute('family','ipv4');
            $source_address = $doc->createElement('source');
            $source_address->setAttribute('address',$ip);
            $port_protocol = $doc->createElement('port');
            $port_protocol->setAttribute('protocol',$tu);
            $port_protocol->setAttribute('port',$pp);
            $accept = $doc->createElement('accept');
            $node->appendChild($source_address);
            $node->appendChild($port_protocol);
            $node->appendChild($accept);
            $parent = $doc->getElementsByTagName('zone')->item(0);
            $parent->appendChild($node);
            $doc->save("/etc/firewalld/zones/public.xml");
        }
        $result = `sudo firewall-cmd --reload`;
    }
    else if($_POST['status']==='permanentDel_ip')
    {
        if(!isset($ip))
        {
            die("δ�ҵ�ip��ַ,����");
        }
        $ports = explode(",",$port);
        foreach($ports as $pp)
        {
            $flag = 0;
            $doc = new DOMDocument('1.0','utf8');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;
            $doc->load("/etc/firewalld/zones/public.xml");
            $xpath = new DOMXPath($doc);
            
            $exp = "//rule[@family='ipv4']";
            $nodes = $xpath->query($exp);
            foreach($nodes as $node)
            {
                if($node->childNodes->item(0)->attributes->item(0)->nodeValue==$ip &&
                $node->childNodes->item(1)->attributes->item(0)->nodeValue==$tu && 
                $node->childNodes->item(1)->attributes->item(1)->nodeValue==$pp)
                {
                    $flag = 1;
                    $target = $node;
                    break;
                }
            }
            if($flag!=1)    //û�ҵ����˳�
            {
                continue;
            }
            $target->parentNode->removeChild($target);
            $doc->save("/etc/firewalld/zones/public.xml");
        }
        $result = `sudo firewall-cmd --reload`;
    }
    if($result=="") //ͨ���Ƚ��Ƿ��ǿ��ַ������ж������Ƿ�ִ�гɹ�����������success�жϲ��ˣ���֪��Ϊɶ...
    {
        echo "failed";
    }
    else
    {
        echo "success";
    }

?>