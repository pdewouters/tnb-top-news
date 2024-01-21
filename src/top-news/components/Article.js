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
					<a href={ url } target="__blank">
						Read full article <span aria-hidden="true">↗</span>
					</a>
				</p>
				<p className="tnb-top_news__article-author">by { author }</p>
				<p className="tnb-top_news__article-source">
					Source: { source.name }
				</p>
				<p className="tnb-top_news__article-publishedAt">
					<time dateTime={ publishedAt }>
						on{ ' ' }
						{ `${ humanReadableDate }, at ${ humanReadableTime }` }
					</time>
				</p>
			</article>
		</li>
	);
}
