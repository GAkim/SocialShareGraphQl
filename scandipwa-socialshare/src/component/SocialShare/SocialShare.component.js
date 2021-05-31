import PropTypes from 'prop-types';
import { PureComponent } from 'react';

import './SocialShare.style';

export class SocialShare extends PureComponent {
    static propTypes = {
        // TODO: implement prop-types
    };

    render() {
        return (
            <div block="SocialShare">
                { __('SocialShare') }
            </div>
        );
    }
}

export default SocialShare;
