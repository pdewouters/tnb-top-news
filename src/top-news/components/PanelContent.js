import Article from './Article';
import { __ } from '@wordpress/i18n';

export default function PanelContent( { status, articles } ) {
	if ( status === 'error' ) {
		return <div>{ __( 'An error occurred', 'tnb-top-news' ) }</div>;
	}
	if ( status === 'loading' ) {
		return <div>{ __( 'Loading…', 'tnb-top-news' ) }</div>;
	}
	if ( ! articles ) {
		return <div>{ __( 'No articles found', 'tnb-top-news' ) }</div>;
	}
	return (
		<>
			<ul className="tnb-top_news__article-list">
				{ articles.map( ( article ) => (
					<Article key={ article.url } articleData={ article } />
				) ) }
			</ul>
		</>
	);
}
