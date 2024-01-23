import { __, sprintf } from '@wordpress/i18n';
export default function Article( { articleData } ) {
	const { title, author, source, publishedAt, url } = articleData;
	const humanReadableDate = new Date( publishedAt ).toLocaleDateString(
		'en-GB',
		{
			day: '2-digit',
			month: 'long',
			year: 'numeric',
		}
	);

	const humanReadableTime = new Date( publishedAt ).toLocaleTimeString(
		'en-GB',
		{
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit',
			hour12: false,
		}
	);
	return (
		<li className="tnb-top_news__article-list-item">
			<article className="tnb-top_news__article">
				<h4 className="tnb-top_news__article-title">{ title }</h4>
				<p className="tnb-top_news__article-link">
					<a href={ url } target="_blank">
						<>
							{ __( 'Read full article', 'tnb-top-news' ) }
							<span aria-hidden="true">↗</span>
						</>
					</a>
				</p>

				<p className="tnb-top_news__article-byline">
					{ sprintf(
						/** translators: %s: author name */
						__( 'Published by %s ', 'tnb-top-news' ),
						author
					) }
					<time dateTime={ publishedAt }>
						{ sprintf(
							/** translators: %1$s: human readable date, %2$s: human readable time */
							__( 'on %1$s, at %2$s', 'tnb-top-news' ),
							humanReadableDate,
							humanReadableTime
						) }
					</time>
				</p>
				<p className="tnb-top_news__article-source">
					{ sprintf(
						/** translators: %s: source name */
						__( 'Source: %s', 'your-text-domain' ),
						source.name
					) }
				</p>
			</article>
		</li>
	);
}
