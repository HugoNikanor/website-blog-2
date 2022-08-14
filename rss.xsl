<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="3.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
<xsl:template match="/">
 <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <title><xsl:value-of select="/rss/channel/title"/> - RSS Flöde</title>
   <meta charset="UTF-8" />
   <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
   <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,shrink-to-fit=no" />
  </head>
  <body>
   <header>
    <h1>RSS-Flöde för <xsl:value-of select="/rss/channel/title"/></h1>
    <p>
     <xsl:value-of select="/rss/channel/description"/>
    </p>
    <a hreflang="sv" target="_blank">
     <xsl:attribute name="href">
      <xsl:value-of select="/rss/channel/link"/>
     </xsl:attribute>
     Gå till faktiska webbsidan &#x2192;
    </a>
   </header>
   <main>
    <h2>Alla inlägg</h2>
    <ul>
     <xsl:for-each select="/rss/channel/item">
      <li>
       <a>
        <xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
        <xsl:value-of select="title"/> -
        <time>
         <xsl:copy-of select="pubDate" />
        </time>
       </a>
      </li>
     </xsl:for-each>
    </ul>
   </main>
  </body>
 </html>
</xsl:template>
</xsl:stylesheet>
