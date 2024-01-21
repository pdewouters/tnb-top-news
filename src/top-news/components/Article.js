export default function Article( { articleData } ) {
	const { title, author, source, publishedAt, url } = articleData;
	// Format the date in British format (Day Month Year)
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
		<li>
			<article>
				<h4>{ title }</h4>
				<p><a href={url}>Read full article</a></p>
				<p>by { author }</p>
				<p>Source: { source.name }</p>
				<p>
					<time dateTime={ publishedAt }>
						on{ ' ' }
						{ `${ humanReadableDate }, at ${ humanReadableTime }` }
					</time>
				</p>
			</article>
		</li>
	);
}
