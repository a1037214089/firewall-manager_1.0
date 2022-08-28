<?php
    session_start();
    if(!isset($_SESSION['isLogin']))
    {
        header("Location:login.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>firewall����ҳ��</title>
    <script type="text/javascript" src="../jquery.js"></script>
    <script>
        function temporaryAdd(){
            var port = $("#port").val();
            var tu = $("#tu").val();
            var status = "temporaryAdd";
            var param = "port="+port+"&tu="+tu+"&status="+status;
            $.post("working.php",param,(data)=>{
                if(data=="success"){
                    window.alert("��ӳɹ�!");
                    location.reload();
                }
                else
                {
                    window.alert("���ʧ��!����")
                }
            })
        }
        function temporaryDel(){
            var port = $("#port").val();
            var tu = $("#tu").val();
            var status = "temporaryDel";
            var param = "port="+port+"&tu="+tu+"&status="+status;
            $.post("working.php",param,(data)=>{
                if(data=="success"){
                    window.alert("ɾ���ɹ�!");
                    location.reload();
                    // window.location = "https://www.baidu.com";
                }
                else
                {
                    window.alert("ɾ��ʧ��!����")
                }
                // window.alert(data);
            })
        }
        function permanentAdd(){
            var port = $("#port").val();
            var tu = $("#tu").val();
            var status = "permanentAdd";
            var param = "port="+port+"&tu="+tu+"&status="+status;
            $.post("working.php",param,(data)=>{
                if(data=="success"){
                    window.alert("��ӳɹ�!");
                    location.reload();
                }
                else
                {
                    window.alert("���ʧ��!����")
                }
            })
        }
        function permanentDel(){
            var port = $("#port").val();
            var tu = $("#tu").val();
            var status = "permanentDel";
            var param = "port="+port+"&tu="+tu+"&status="+status;
            $.post("working.php",param,(data)=>{
                if(data=="success"){
                    window.alert("ɾ���ɹ�!");
                    location.reload();
                }
                else
                {
                    window.alert("ɾ��ʧ��!����")
                }
            })
        }
        function temporaryAdd_ip(){
            var ip = $("#ip").val();
            var ip_ports = $("#ip_ports").val();
            var ip_tu = $("#ip_tu").val();
            var status = "temporaryAdd_ip";
            var param = "ip="+ip+"&port="+ip_ports+"&tu="+ip_tu+"&status="+status;

            $.post("working.php",param,(data)=>{
                if(data=="success")
                {
                    window.alert("��ӳɹ�");
                    window.location = location.href;
                }
                else
                {
                    window.alert("���ʧ��!����");
                }
                // window.alert(data);
            })
        }
        function temporaryDel_ip(){
            var ip = $("#ip").val();
            var ip_ports = $("#ip_ports").val();
            var ip_tu = $("#ip_tu").val();
            var status = "temporaryDel_ip";
            var param = "ip="+ip+"&port="+ip_ports+"&tu="+ip_tu+"&status="+status;

            $.post("working.php",param,(data)=>{
                if(data=="success")
                {
                    window.alert("ɾ���ɹ�");
                    window.location = location.href;
                }
                else
                {
                    window.alert("ɾ��ʧ��!����");
                }
            })
        }
        function permanentAdd_ip(){
            var ip = $("#ip").val();
            var ip_ports = $("#ip_ports").val();
            var ip_tu = $("#ip_tu").val();
            var status = "permanentAdd_ip";
            var param = "ip="+ip+"&port="+ip_ports+"&tu="+ip_tu+"&status="+status;

            $.post("working.php",param,(data)=>{
                if(data=="success")
                {
                    window.alert("��ӳɹ�");
                    window.location = location.href;
                }
                else
                {
                    window.alert("���ʧ��!����");
                }
                // window.alert(data);
            })
        }
        function permanentDel_ip(){
            var ip = $("#ip").val();
            var ip_ports = $("#ip_ports").val();
            var ip_tu = $("#ip_tu").val();
            var status = "permanentDel_ip";
            var param = "ip="+ip+"&port="+ip_ports+"&tu="+ip_tu+"&status="+status;

            $.post("working.php",param,(data)=>{
                if(data=="success")
                {
                    window.alert("ɾ���ɹ�");
                    window.location = location.href;
                }
                else
                {
                    window.alert("ɾ��ʧ��!����");
                }
                // window.alert(data);
            })
        }
    </script>
    <style>
        body{
            background-color: aliceblue;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .Container{
            width: 100%;
        }
        table,tr,td{
            border: 3px solid green;
            border-collapse: collapse;
            width: 1000px;
            margin: auto;
            text-align: center;
        }
        td{
            height: 100px;
        }
        p{
            text-align: center;
            color: #0000CD;
            font-weight: 1000;
            font-size: 36px;
        }
        .version{
            width: 72px;
            font-size: 18px;
            margin: auto;
            font-weight: 1000;
        }
    </style>
</head>
<body>
    <div class="Container">
        <table>
            <tr>
                <td>�ѿ��ŵĶ˿�(������IP��ַ����)</td>
                <td>
                    <?php
                        $result = `sudo firewall-cmd --list-all`;
                        preg_match_all("/ports: (.*)/",$result,$tmp);
                        $ports = explode(" ",$tmp[1][0]);
                        foreach($ports as $value)
                        {
                            echo $value." ";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    �ѱ�д�ĸ�����
                </td>
                <td>
                    <?php
                        $result = `sudo firewall-cmd --list-all`;
                        preg_match_all("/(rule family.*)/",$result,$rich_rules);
                        // print_r($rich_rule);
                        foreach($rich_rules[0] as $rich_rule)
                        {
                            echo $rich_rule;
                            echo "<br>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    ��Ҫ���ŵĶ˿ں�:<input type="text" name="port" id="port"><br>
                    tcp����udp:<select name="tu" id="tu">
                        <option value="tcp">tcp</option>
                        <option value="udp">udp</option>
                    </select><br>
                    <input type="submit" value="��ʱ����" name="temporaryAdd" onclick="temporaryAdd()">
                    <input type="submit" value="���ÿ���" name="permanentAdd" onclick="permanentAdd()"><br>
                    <input type="submit" value="��ʱ�ر�" name="temporaryDel" onclick="temporaryDel()">
                    <input type="submit" value="���ùر�" name="permanentDel" onclick="permanentDel()">
                </td>
                <td>
                    PS:������Ե��Ƕ˿ڵķ��ʿ���,�������嵽ip��ַ��
                </td>
            </tr>
            <tr>
                <td>
                    ��Ҫ������IP��ַ:<input type="text" name="ip" id="ip"><br>
                    ���Ӧ�Ķ˿ں�:<input type="text" name="ip_ports" id="ip_ports"><br>
                    tcp����udp:<select name="ip_tu" id="ip_tu">
                        <option value="tcp">tcp</option>
                        <option value="udp">udp</option>
                    </select><br>
                    <input type="submit" value="��ʱ����" name="temporaryAdd_ip" onclick="temporaryAdd_ip()">
                    <input type="submit" value="���ÿ���" name="permanentAdd_ip" onclick="permanentAdd_ip()"><br>
                    <input type="submit" value="��ʱ�ر�" name="temporaryDel_ip" onclick="temporaryDel_ip()">
                    <input type="submit" value="���ùر�" name="permanentDel_ip" onclick="permanentDel_ip()">
                </td>
                <td>
                    PS:���ڸ�����Ĳ��Ա�д������ж���˿ں���Ҫ����������','���ֿ�
                </td>
            </tr>
        </table>
        <p>
            �������������������簲ȫ����ҡ�<br>
            �������Բ��淶���ϰ�ͻ������ᡣ
        </p>
        <div class="version">version:1.0</div>
    </div>
</body>
</html>