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
    <title>firewall管理页面</title>
    <script type="text/javascript" src="../jquery.js"></script>
    <script>
        function temporaryAdd(){
            var port = $("#port").val();
            var tu = $("#tu").val();
            var status = "temporaryAdd";
            var param = "port="+port+"&tu="+tu+"&status="+status;
            $.post("working.php",param,(data)=>{
                if(data=="success"){
                    window.alert("添加成功!");
                    location.reload();
                }
                else
                {
                    window.alert("添加失败!请检查")
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
                    window.alert("删除成功!");
                    location.reload();
                    // window.location = "https://www.baidu.com";
                }
                else
                {
                    window.alert("删除失败!请检查")
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
                    window.alert("添加成功!");
                    location.reload();
                }
                else
                {
                    window.alert("添加失败!请检查")
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
                    window.alert("删除成功!");
                    location.reload();
                }
                else
                {
                    window.alert("删除失败!请检查")
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
                    window.alert("添加成功");
                    window.location = location.href;
                }
                else
                {
                    window.alert("添加失败!请检查");
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
                    window.alert("删除成功");
                    window.location = location.href;
                }
                else
                {
                    window.alert("删除失败!请检查");
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
                    window.alert("添加成功");
                    window.location = location.href;
                }
                else
                {
                    window.alert("添加失败!请检查");
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
                    window.alert("删除成功");
                    window.location = location.href;
                }
                else
                {
                    window.alert("删除失败!请检查");
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
                <td>已开放的端口(对所有IP地址开放)</td>
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
                    已编写的富规则
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
                    想要开放的端口号:<input type="text" name="port" id="port"><br>
                    tcp还是udp:<select name="tu" id="tu">
                        <option value="tcp">tcp</option>
                        <option value="udp">udp</option>
                    </select><br>
                    <input type="submit" value="临时开启" name="temporaryAdd" onclick="temporaryAdd()">
                    <input type="submit" value="永久开启" name="permanentAdd" onclick="permanentAdd()"><br>
                    <input type="submit" value="临时关闭" name="temporaryDel" onclick="temporaryDel()">
                    <input type="submit" value="永久关闭" name="permanentDel" onclick="permanentDel()">
                </td>
                <td>
                    PS:该项针对的是端口的访问控制,并不具体到ip地址。
                </td>
            </tr>
            <tr>
                <td>
                    想要操作的IP地址:<input type="text" name="ip" id="ip"><br>
                    其对应的端口号:<input type="text" name="ip_ports" id="ip_ports"><br>
                    tcp还是udp:<select name="ip_tu" id="ip_tu">
                        <option value="tcp">tcp</option>
                        <option value="udp">udp</option>
                    </select><br>
                    <input type="submit" value="临时开启" name="temporaryAdd_ip" onclick="temporaryAdd_ip()">
                    <input type="submit" value="永久开启" name="permanentAdd_ip" onclick="permanentAdd_ip()"><br>
                    <input type="submit" value="临时关闭" name="temporaryDel_ip" onclick="temporaryDel_ip()">
                    <input type="submit" value="永久关闭" name="permanentDel_ip" onclick="permanentDel_ip()">
                </td>
                <td>
                    PS:基于富规则的策略编写，如果有多个端口号需要操作，可用','来分开
                </td>
            </tr>
        </table>
        <p>
            文明上网你我他，网络安全靠大家。<br>
            防御策略不规范，老板客户两行泪。
        </p>
        <div class="version">version:1.0</div>
    </div>
</body>
</html>