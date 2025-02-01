<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=Windows-1256">
<TITLE>FPDF</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="fpdf.css">
</HEAD>
<BODY>
<H2 DIR='LTR'>FPDF</H2>
<P DIR='LTR'><TT>FPDF([<B>string</B> orientation [, <B>string</B> unit [, <B>mixed</B> format]]])</TT></P>
<H4 CLASS='st'>الإصدار</H4>
1.0
<H4 CLASS='st'>الشرح</H4>
هذه الدالة هي دالة البناء او الإقلاع (المشيد) لكلاس FPDF  وتسمح بتحميل متغيرات الكلاس ومختلف التنسيقات الخاصة بالمستند بإستثناء حجم الخط في المستند
<H4 CLASS='st'>باراميتر</H4>
<TT><U>orientation</U></TT>
<BLOCKQUOTE>
يحدد هذا البارامتر طريقة توجيه الصفحة وهو يأخذ احد القيم التالية مع مراعة انها حساسة لحالة الاحرف
<UL>
<LI><TT>P</TT> أو <TT>Portrait</TT>
<LI><TT>L</TT> أو <TT>Landscape</TT>
</UL>
القيمة الإفتراضية <TT>P</TT>.
</BLOCKQUOTE>
<TT><U>unit</U></TT>
<BLOCKQUOTE>
يتم في هذا البارامتر تحديد وحدة العرض في المستند
<UL>
<LI><TT>pt</TT>: النقطة
<LI><TT>mm</TT>: ميليميتر
<LI><TT>cm</TT>: سنتيميتر
<LI><TT>in</TT>: إنش
</UL>
النقطة تساوي 1 / 72 إنش وتستطيع القول 0.35 مليميتر والإنش 2.54 سنتيميتر وهذه هي الوحدة الأكثر إستخداماً
<BR>
<BR>
والقيمة الإفتراضية المستخدمة هي المليميتر<TT>mm</TT>.
</BLOCKQUOTE>
<TT><U>format</U></TT>
<BLOCKQUOTE>
يستخدم هذا البارامتر لتحديد تنسيق الصفحة وهو يأخذ أحد القيم التالية الخاصة بحجم الورق مع التنبيه ان هذه القيم حساسة لحالة الأحرف
<UL>
<LI><TT>A3</TT>
<LI><TT>A4</TT>
<LI><TT>A5</TT>
<LI><TT>Letter</TT>
<LI><TT>Legal</TT>
</UL>
او يمكن تخصيص تنسيق معين مكون من مصفوفة ثنائية البعد تحتوي على العرض والإرتفاع ويمكن التعبير عنها بالوحدة (<TT>unit</TT>).
</BLOCKQUOTE>
<HR STYLE="margin-top:1.5em">
<DIV STYLE="text-align:center"><A HREF="index.htm">الرئيسية</A></DIV>
</BODY>
</HTML>
