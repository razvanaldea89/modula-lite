import icons from '../utils/icons';
import ModulaGalleryImageInner from './ModulaGalleryImageInner';

const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
const { Button, ButtonGroup } = wp.components;
const { MediaUpload, MediaPlaceholder } = wp.blockEditor;

const ModulaGalleryImage = (props) => {
	const { images, settings, id, effectCheck } = props.attributes;

	const { img, index, setAttributes, checkHoverEffect } = props;

	return [
		/** REMINDER : Check for data with & height */
		<div className={`modula-item effect-${settings.effect}`} data-width="2" data-height="2">
			<div className="modula-item-overlay" />

			<div className="modula-item-content">
				<img
					style={{height: 'auto', width: '400px'}}
					className={`modula-image pic`}
					data-id={img.id}
					data-full={img.src}
					data-src={img.src}
					data-valign="middle"
					data-halign="center"
					data-width="2"
					data-height="2"
					src={img.src}
				/>
				{'slider' !== settings.type && (
					<ModulaGalleryImageInner
						settings={settings}
						img={img}
						index={index}
						hideTitle={undefined != effectCheck && effectCheck.title == true ? false : true}
						hideDescription={undefined != effectCheck && effectCheck.description == true ? false : true}
						hideSocial={undefined != effectCheck && effectCheck.social == true ? false : true}
						effectCheck={effectCheck}
					/>
				)}
			</div>
		</div>
	];
};

export default ModulaGalleryImage;
