<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <head>
    <style>
        body{
            margin: 0;
            width: 100%;
            height: 100%;
            background: #181819;
            color: #7c7b7b;
            font-family: Roboto-Regular;
        }

        .content-width{
            width: max-content;
        }

        .content-height{
            height: max-content;
        }

        .flex{
            display: flex;
            align-items: left;
            justify-content: left;
        }

        .flex-wrap{
            flex-wrap: wrap;
        }

        :root{
            --browse-gallery-node-shade: linear-gradient(rgba(0,0,0,.1), rgba(0,0,0,.2), rgba(0,0,0,.7));
        }

        div#browse-gallery{
            padding: 1rem;
            gap: 1rem;
        }

        div#browse-gallery div.browse-gallery-node{
            width: 12rem;
            height: 17rem;
            background-image: var(--browse-gallery-node-shade);
            background-size: cover;
            background-position: center;
            box-shadow: 0px 0px 20px rgb(0, 19, 17);
            justify-content: flex-start;
            border-radius: 2%;
            padding: .5rem;
            flex-direction: column;        
            color: rgba(255,255,255,.9);
            /* border-left: 5px solid rgba(12, 65, 81, 1); */
            float:left;
            margin:15px;
        }

        div#browse-gallery div.browse-gallery-node span{
            background: #0c4151;
            padding: .1rem .2rem;
            border-radius: 20%;
            font-size: .7rem;
            opacity: .9;
            align-items:left;
        }

        div#browse-gallery div.movie-details{
            flex-direction: column;
            padding: .5rem;
            float:left;
            margin:15px;
        }

        div#browse-gallery div.movie-details h1{
          color: rgba(255,255,255,.9);
          text-shadow: 0px 0px 10px lightsalmon;
        }

        div#browse-gallery div.movie{
            display:inline-block;
            width: 50rem;  
        }
    </style>
  </head>
  <body>
  <h1>MIRUI Movies Library</h1>  
    <div id="browse-gallery" class="content-height">
      <xsl:for-each select="mirui/movies/movie"> 
        <div class="movie">
          <div id="browse-gallery-node" class="browse-gallery-node flex">
              <span class="browse-gallery-node-score content-width"><xsl:value-of select="score"/></span>
          </div>
          <div id="movie-details" class="movie-details flex">
              <h1><xsl:value-of select="title/primary"/></h1>
              <h3><xsl:value-of select="title/secondary"/></h3>
        
              <p>
                <xsl:value-of select="description/primary"/><br/>
                <xsl:value-of select="description/secondary"/>
              </p>

              <p>
                Genre: <xsl:value-of select="genre"/><br/>
                Language: <xsl:value-of select="language"/><br/>
                Subtitle: <xsl:value-of select="subtitle"/><br/>
                Country: <xsl:value-of select="country"/>
              </p>

              <p>
                Rating: <xsl:value-of select="rating"/><br/>
                Run time: <xsl:value-of select="runtime"/>
              </p>

              <p>
                Director: <xsl:value-of select="director"/><br/>
                Cast: <xsl:value-of select="cast"/><br/>
                Release Date: <xsl:value-of select="dateRelease"/>
              </p>

            <p>
              Created at: <xsl:value-of select="created"/><br/>
              Updated at: <xsl:value-of select="updated"/>
            </p>
          </div> 
        </div>
      </xsl:for-each>
    </div>
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>