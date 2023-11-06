<rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:admin="http://webns.net/mvcb/"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>

        <title><?php echo $feed_name; ?></title>

        <link><?php echo $feed_url; ?></link>
        <description><?php echo $page_description; ?></description>
        <dc:language><?php echo $page_language; ?></dc:language>
        <dc:creator><?php echo $creator_email; ?></dc:creator>

        <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
        <?php foreach($posts as $post): ?>
            <item>

                <title><?php echo xml_convert($post['title']); ?></title>
                <link><?php echo base_url('analysis/article/' . $post['id']) ?></link>
                <guid><?php echo base_url('analysis/article/' . $post['id']) ?></guid>

                <description><![CDATA[ <?php echo $post['content']; ?> ]]></description>
                <pubDate><?php echo date('D M j H:i:s e Y', strtotime($post['date_created'])); ?></pubDate>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>