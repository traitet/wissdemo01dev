USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_eps_pr_for_cp]    Script Date: 3/5/2022 12:27:24 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- wiss_sa_inventory_stock_out_error
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 03-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_eps_pr_for_cp]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS

    SELECT TOP(@record_count)
        a.PRFORM_LINE_ROWID, a.PRNUM, a.ITEMNO, a.MATID, a.MATDESC, a.EXPENSEID, a.INVESTMENTID, a.PRODUCTID, a.PRODUCTDESC,
        a.PRODUCTLINEID, a.PRODUCTLINEDESC, a.MACHINEID, a.MACHINEDESC, a.REQUIREDDATE, a.SHIPTO, a.QTY, a.PRICE, a.UNIT, a.AMOUNT,
        a.REMARK, a.PRFROM_FILE_ID1, a.PRFROM_FILE_ID2, a.PRFROM_FILE_ID3, a.[DESCRIPTION], a.STATUS, a.CREATEDBY, a.CREATEDDATE,
        a.CREATEDTIME, a.EDITEDBY, a.EDITEDDATE, a.EDITEDTIME, a.ENABLED, a.COMMENT1, a.COMMENT2, a.COMMENT3, a.COMMENT4, a.COMMENT5,
        a.NUMERIC1, a.NUMERIC2, a.TEXT1, a.TEXT2, a.GOODSTYPE, a.SERVICEDURATION, a.SERVICESTARTDATE , 'xxxxxxx' as afrerThisColumnIsPritemLine ,
        b.PRITEM_LINE_ROWID, b.PRFORM_LINE_ROWID, b.PRNUM, b.ITEMNO, b.MATID, b.MATDESC, b.BUDGETTYPE, b.EXPENSEID, b.INVESTMENTID, b.PRODUCTID,
        b.PRODUCTDESC, b.PRODUCTLINEID, b.PRODUCTLINEDESC, b.MACHINEID, b.MACHINEDESC, b.REQUIREDDATE, b.SHIPTO, b.QTY, b.PRICE, b.UNIT, b.AMOUNT,
        b.IS_VAT, b.VAT, b.IS_WHT, b.WHTID, b.WHTDESC, b.SAVECOSTTYPE, b.SAVECOST, b.PURCHASETYPE, b.ASSETTYPE, b.REMARK, b.ACCOUNTCODE, b.BUYER,
        b.VENDORID, b.VENDORNAME, b.IS_VARIABLE, b.CURRENTGROUP, b.CURRENTSTAGE, b.CURRENTDATE, b.CURRENTTIME, b.NEXTGROUP, b.NEXTSTAGE, b.NEXTDATE,
        b.NEXTTIME, b.SENIORBUYERCOMMENT, b.BUYERCOMMENT, b.CPINVCOMMENT, b.CPACCCOMMENT, b.COSTCOMMENT, b.PONUM, b.[DESCRIPTION], b.STATUS,
        b.CREATEDBY, b.CREATEDDATE, b.CREATEDTIME, b.EDITEDBY, b.EDITEDDATE, b.EDITEDTIME, b.ENABLED, b.COMMENT1, b.COMMENT2, b.COMMENT3,
        b.COMMENT4, b.COMMENT5, b.NUMERIC1, b.NUMERIC2, b.TEXT1, b.TEXT2, b.GOODSTYPE, b.SERVICEDURATION, b.SERVICESTARTDATE
    FROM
        TT_PRFORM_LINE as a
        join
        TT_PRITEM_LINE as b
        on a.prnum = b.prnum and a.itemno = b.itemno
    WHERE
        a.createddate>=@start_date AND
        a.createddate<=@end_date AND
        a.PRNUM LIKE '%' + @doc_num + '%'

-- EXEC wiss_sa_eps_pr_for_cp '20200101', '20990101','PR22',100

